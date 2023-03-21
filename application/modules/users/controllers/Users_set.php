<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged') == NULL) {
        header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
        $list_access = array(SUPERUSER);
        if (!in_array($this->session->userdata('uroleid'),$list_access)) {
            redirect('manage');
        }
       
        $this->load->model('users/Users_model');
        $this->load->helper(array('form', 'url'));
    }

     // User_customer view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
        $f = $this->input->get(NULL, TRUE);

        $data['f'] = $f;

        $params = array();
        // Nip
        if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
            $params['search'] = $f['n'];
        }

        $paramsPage = $params;
        $params['limit'] = 5;
        $params['offset'] = $offset;
        $data['user'] = $this->Users_model->get($params);

        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('manage/users/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Users_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Pengguna';
        $data['main'] = 'users/user_list';
        $this->load->view('manage/layout', $data);
    }

    // Add User and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');

        if (!$this->input->post('user_id')) {
            $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean|min_length[6]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'trim|required|xss_clean|min_length[6]|matches[user_password]');
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|xss_clean|is_unique[users.user_email]');
            $this->form_validation->set_message('passconf', 'Password dan konfirmasi password tidak cocok');
        }
        $this->form_validation->set_rules('role_id', 'Peran', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user_full_name', 'Nama lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button position="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('user_id')) {
                $params['user_id'] = $id;
            } else {
                $params['user_input_date'] = date('Y-m-d H:i:s');
                $params['user_email'] = $this->input->post('user_email');
                $params['user_password'] = sha1($this->input->post('user_password'));
            }
            $params['user_role_role_id'] = $this->input->post('role_id');
            $params['user_last_update'] = date('Y-m-d H:i:s');
            $params['user_full_name'] = $this->input->post('user_full_name');
            $params['user_description'] = $this->input->post('user_description'); 
            $params['user_last_update'] = date('Y-m-d H:i:s');
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
                        'log_module' => 'user',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:' . $status . ';Name:' . $this->input->post('user_full_name')
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Pengguna Berhasil');
            redirect('manage/users');
        } else {
            if ($this->input->post('user_id')) {
                redirect('manage/users/edit/' . $this->input->post('user_id'));
            }
 
            // Edit mode
            if (!is_null($id)) {
                $object = $this->Users_model->get(array('id' => $id));
                if ($object == NULL) {
                    redirect('manage/users');
                } else {
                    $data['user'] = $object;
                }
            }
            $data['roles'] = $this->Users_model->get_role();
            $data['title'] = $data['operation'] . ' Pengguna';
            $data['main'] = 'users/user_add';
            $this->load->view('manage/layout', $data);
        }
    }

    // View data detail
    public function view($id = NULL) {
        $data['user'] = $this->Users_model->get(array('id' => $id));
        $data['title'] = 'Pengguna';
        $data['main'] = 'users/user_view';
        $this->load->view('manage/layout', $data);
    }

    // Delete to database
    public function delete($id = NULL) {
       if ($this->session->userdata('uroleid')!= SUPERUSER){
          redirect('manage');
        }
        if ($_POST) {
            $this->Users_model->delete($id);
            // activity log
            $this->load->model('logs/Logs_model');
            $this->Logs_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('uid'),
                        'log_module' => 'user',
                        'log_action' => 'Hapus',
                        'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
                    )
            );
            $this->session->set_flashdata('success', 'Hapus Pengguna berhasil');
            redirect('manage/users');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('manage/users/edit/' . $id);
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
            $this->session->set_flashdata('success', $this->upload->display_errors('', ''));
            redirect(uri_string());
        }

        $upload_data = $this->upload->data();

        return $upload_data['file_name'];
    }


    function rpw($id = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|min_length[6]|matches[user_password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $id = $this->input->post('user_id');
            $params['user_password'] = sha1($this->input->post('user_password'));
            $status = $this->Users_model->change_password($id, $params);

            // activity log
            $this->load->model('logs/Logs_model');
            $this->Logs_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('uid'),
                        'log_module' => 'Pengguna',
                        'log_action' => 'Reset Password',
                        'log_info' => 'ID:null;Title:' . $this->input->post('user_nik')
                    )
            );
            $this->session->set_flashdata('success', 'Reset Password Berhasil');
            redirect('manage/users');
        } else {
            if ($this->Users_model->get(array('id' => $id)) == NULL) {
                redirect('manage/users');
            }
            $data['user'] = $this->Users_model->get(array('id' => $id));
            $data['title'] = 'Reset Password';
            $data['main'] = 'users/change_pass';
            $this->load->view('manage/layout', $data);
        }
    }

}
