<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_set extends CI_Controller {
    
  public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('users/Users_model','logs/Logs_model'));
        $this->load->helper(array('form', 'url'));
    }
    
    public function index($offset = NULL) {
        $id = $this->session->userdata('uid');
        if ($this->Users_model->get(array('id' => $id)) == NULL) {
            redirect('manage/users');
        }
        $data['user'] = $this->Users_model->get(array('id' => $id));
        $data['title'] = 'Detail Profil';
        $data['main'] = 'profile/profile_view';
        $this->load->view('manage/layout', $data);
    }
     
    // Add User and Update
    public function edit($id = NULL) {
        $data['operation'] = 'Edit';

 
        if ($_POST == TRUE) {

            $params['user_id'] = $this->input->post('user_id');
            $params['user_role_role_id'] = $this->input->post('role_id');
            $params['user_last_update'] = date('Y-m-d H:i:s');
            $params['user_full_name'] = $this->input->post('user_full_name');
            $params['user_description'] = $this->input->post('user_description');
            $status = $this->Users_model->add($params);
            if (!empty($_FILES['user_image']['name'])) {
                $paramsupdate['user_image'] = $this->do_upload($name = 'user_image', $fileName= $params['user_full_name']);
            }

            $paramsupdate['user_id'] = $status;
            $this->Users_model->add($paramsupdate);

            // activity log
            $this->load->model('logs/Logs_model');
            $this->Logs_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('uid'),
                        'log_module' => 'Profile',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:' . $status . ';Name:' . $this->input->post('user_full_name')
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Pengguna Berhasil');
            redirect('manage/profile');
        } else {
            if ($this->input->post('user_id')) {
                redirect('manage/profile/edit/' . $this->input->post('user_id'));
            }

            // Edit mode
            $data['user'] = $this->Users_model->get(array('id' => $this->session->userdata('uid')));
            $data['roles'] = $this->Users_model->get_role();
            $data['title'] = $data['operation'] . ' Pengguna';
            $data['main'] = 'profile/profile_edit';
            $this->load->view('manage/layout', $data);
        }
    }

    // Setting Upload File Requied
    function do_upload($name=NULL, $fileName=NULL) {
        $this->load->library('upload');

        $config['upload_path'] = FCPATH . 'uploads/users/';

        /* create directory if not exist */
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '32000';
        $config['file_name'] = $fileName;
                $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
            $this->session->set_flashdata('failed', $this->upload->display_errors('', ''));
            redirect(uri_string());
        }

        $upload_data = $this->upload->data();

        return $upload_data['file_name'];
    }

    // Change Password Manage
    function cpw() {
        $this->load->model('Logs_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'required|matches[passconf]|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]');
        $this->form_validation->set_rules('user_current_password', 'Old Password', 'required|callback_check_current_password');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $old_password = $this->input->post('user_current_password');

            $params['user_password'] = sha1($this->input->post('user_password'));
            $status = $this->Users_model->change_password($this->session->userdata('uid'), $params);

            // activity log
            $this->Logs_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('uid'),
                        'log_module' => 'Pengguna',
                        'log_action' => 'Ganti Password',
                        'log_info' => 'ID:null;Title:' . $this->input->post('user_name')
                    )
            );
            $this->session->set_flashdata('success', 'Ubah password Pengguna berhasil');
            redirect('manage/profile');
        } else {
            if ($this->Users_model->get(array('id' => $this->session->userdata('uid'))) == NULL) {
                redirect('manage');
            }
            $data['title'] = 'Ganti Password Pengguna';
            $data['main'] = 'profile/change_pass';
            $this->load->view('manage/layout', $data);
        }
    }

    function check_current_password() {

        $pass = $this->input->post('user_current_password');
        $user = $this->Users_model->get(array('id' => $this->session->userdata('uid')));
        if (sha1($pass) == $user['user_password']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_current_password', 'The Password did not same with the current password');
            return FALSE;
        }
    }
    
}
