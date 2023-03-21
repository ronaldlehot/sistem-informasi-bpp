<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_set extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    public function index() {
        $this->load->model('setting/Setting_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('setting_school', 'Nama Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('setting_address', 'Alamat', 'trim|required|xss_clean');
        $this->form_validation->set_rules('setting_phone', 'Nomor Telephone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('setting_district', 'Nama Kecamatan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('setting_city', 'Nama Kota/Kab', 'trim|required|xss_clean');
         $this->form_validation->set_rules('setting_level', 'Tingkat', 'trim|required|xss_clean');
         $this->form_validation->set_rules('setting_user_sms', 'User SMS Gateway', 'trim|required|xss_clean');
         $this->form_validation->set_rules('setting_pass_sms', 'Pass SMS Gateway', 'trim|required|xss_clean');

        if ($_POST AND $this->form_validation->run() == TRUE) {

            $param['setting_school'] = $this->input->post('setting_school');
            $param['setting_address'] = $this->input->post('setting_address');
            $param['setting_phone'] = $this->input->post('setting_phone');
            $param['setting_district'] = $this->input->post('setting_district');
            $param['setting_city'] = $this->input->post('setting_city');
            $param['setting_level'] = $this->input->post('setting_level');
            $param['setting_user_sms'] = $this->input->post('setting_user_sms');
            $param['setting_pass_sms'] = $this->input->post('setting_pass_sms');
            $param['setting_sms'] = $this->input->post('setting_sms');

            $status =$this->Setting_model->save($param);

            if (!empty($_FILES['setting_logo']['name'])) {
                $paramsupdate['setting_logo'] = $this->do_upload($name = 'setting_logo', $fileName= $param['setting_school']);

                $paramsupdate['setting_id'] = $status;
                $this->Setting_model->save($paramsupdate);
            } 

            $this->session->set_flashdata('success', ' Sunting pengaturan berhasil');
            redirect('manage/setting');
        } else {
            $data['title'] = 'Pengaturan';
            $data['setting_school'] = $this->Setting_model->get(array('id' => 1));
            $data['setting_address'] = $this->Setting_model->get(array('id' => 2));
            $data['setting_phone'] = $this->Setting_model->get(array('id' => 3));
            $data['setting_district'] = $this->Setting_model->get(array('id' => 4));
            $data['setting_city'] = $this->Setting_model->get(array('id' => 5));
            $data['setting_logo'] = $this->Setting_model->get(array('id' => 6));
            $data['setting_level'] = $this->Setting_model->get(array('id' => 7));
            $data['setting_user_sms'] = $this->Setting_model->get(array('id' => 8));
            $data['setting_pass_sms'] = $this->Setting_model->get(array('id' => 9));
            $data['setting_sms'] = $this->Setting_model->get(array('id' => 10));
            
            $data['main'] = 'setting/setting_list';
            $this->load->view('manage/layout', $data);
        }
    }

    // Setting Upload File Requied
    function do_upload($name=NULL, $fileName=NULL) {
        $this->load->library('upload');

        $config['upload_path'] = FCPATH . 'uploads/school/';

        /* create directory if not exist */
        if (!is_dir($config['upload_path'])) {
          mkdir($config['upload_path'], 0777, TRUE);
      }

      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['max_size'] = '1024';
      $config['file_name'] = $fileName;
      $this->upload->initialize($config);

      if (!$this->upload->do_upload($name)) {
          $this->session->set_flashdata('success', $this->upload->display_errors('', ''));
          redirect(uri_string());
      }

      $upload_data = $this->upload->data();

      return $upload_data['file_name'];
  } 

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
