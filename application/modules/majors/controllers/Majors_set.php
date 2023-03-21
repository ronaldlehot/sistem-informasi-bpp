<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Majors_set extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }

    if (majors() != 'senior') {
      redirect('manage');
    }

    $this->load->model(array('student/Student_model', 'setting/Setting_model'));
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
      $params['majors_name'] = $f['n'];
    }

    $paramsPage = $params;
    $params['limit'] = 10;
    $params['offset'] = $offset;
    $data['majors'] = $this->Student_model->get_majors($params);
    $data['setting_logo'] = $this->Setting_model->get(array('id' => 6));
    $config['per_page'] = 10;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/majors/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Student_model->get_class($paramsPage));
    $this->pagination->initialize($config);

    $data['title'] = 'Program Keahlian';
    $data['main'] = 'majors/majors_list';
    $this->load->view('manage/layout', $data);
  }

  public function add_glob(){
    if ($_POST == TRUE) {
      $majorsName = $_POST['majors_name'];
      $majorsShort = $_POST['majors_short_name'];
      $cpt = count($_POST['majors_name']);
      for ($i = 0; $i < $cpt; $i++) {
        $params['majors_name'] = $majorsName[$i];
        $params['majors_short_name'] = $majorsShort[$i];

        $this->Student_model->add_majors($params);
      }
    }
    $this->session->set_flashdata('success',' Tambah Program Keahlian Berhasil');
    redirect('manage/majors');
  }

// Add User_customer and Update
  public function add($id = NULL) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('majors_name', 'Nama Program Keahlian', 'trim|required|xss_clean');
    $this->form_validation->set_rules('majors_short_name', 'Singkatan Program Keahlian', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button ket="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if ($this->input->post('majors_id')) {
        $params['majors_id'] = $this->input->post('majors_id');
      }
      $params['majors_name'] = $this->input->post('majors_name');
      $params['majors_short_name'] = $this->input->post('majors_short_name');
      $status = $this->Student_model->add_majors($params);


      $this->session->set_flashdata('success', $data['operation'] . ' Keterangan Kelas');
      redirect('manage/majors');

      if ($this->input->post('from_angular')) {
        echo $status;
      }
    } else {
      if ($this->input->post('majors_id')) {
        redirect('manage/majors/edit/' . $this->input->post('majors_id'));
      }

            // Edit mode
      if (!is_null($id)) {
        $object = $this->Student_model->get_majors(array('id' => $id));
        if ($object == NULL) {
          redirect('manage/majors');
        } else {
          $data['majors'] = $object;
        }
      }
      $data['title'] = $data['operation'] . ' Program Keahlian';
      $data['main'] = 'majors/majors_add';
      $this->load->view('manage/layout', $data);
    }
  }


// Delete to database
  public function delete($id = NULL) {
    if ($this->session->userdata('uroleid')!= SUPERUSER){
      redirect('manage');
    }
    if ($_POST) {

      $siswa = $this->Student_model->get(array('majors_id'=>$id));

      if (count($siswa) > 0) {
        $this->session->set_flashdata('failed', 'Data Program Keahlian tidak dapat dihapus');
        redirect('manage/majors');
      }

      $this->Student_model->delete_majors($id);
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
      $this->session->set_flashdata('success', 'Hapus Program Keahlian berhasil');
      redirect('manage/majors');
    } elseif (!$_POST) {
      $this->session->set_flashdata('delete', 'Delete');
      redirect('manage/majors/edit/' . $id);
    }  
  }
}
