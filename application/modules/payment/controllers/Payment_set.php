<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Payment_set extends CI_Controller {

  public function __construct() {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('payment/Payment_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'logs/Logs_model'));

  }

    // payment view in list
  public function index($offset = NULL) {
    $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $params = array();
        // Tahun Ajaran
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['search'] = $f['n'];
    }

    $paramsPage = $params;
    $params['limit'] = 5;
    $params['offset'] = $offset;
    $data['payment'] = $this->Payment_model->get($params);

    $config['per_page'] = 5;
    $config['uri_segment'] = 4;
    $config['base_url'] = site_url('manage/payment/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Payment_model->get($paramsPage));
    $this->pagination->initialize($config);

    $data['title'] = 'Jenis Pembayaran';
    $data['main'] = 'payment/payment_list';
    $this->load->view('manage/layout', $data);
  }

    // Add payment and Update
  public function add($id = NULL) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('pos_id', 'Jenis POS', 'trim|required|xss_clean');
    $this->form_validation->set_rules('period_id', 'Tahun Ajaran', 'trim|required|xss_clean');

    $this->form_validation->set_rules('payment_type', 'Tipe', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
    $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if ($this->input->post('payment_id')) {
        $params['payment_id'] = $this->input->post('payment_id');
      } else {
        $params['payment_input_date'] = date('Y-m-d H:i:s');
      }

      $params['payment_last_update'] = date('Y-m-d H:i:s');
      $params['payment_type'] = $this->input->post('payment_type');
      $params['period_id'] = $this->input->post('period_id');
      $params['pos_id'] = $this->input->post('pos_id');

      $status = $this->Payment_model->add($params);
      $paramsupdate['payment_id'] = $status;
      $this->Payment_model->add($paramsupdate);

            // activity log
      $this->Logs_model->add(
        array(
          'log_date' => date('Y-m-d H:i:s'),
          'user_id' => $this->session->userdata('user_id'),
          'log_module' => 'Jenis Pembayaran',
          'log_action' => $data['operation'],
          'log_info' => 'ID:null;Title:'
        )
      );

      $this->session->set_flashdata('success', $data['operation'] . ' Pembayaran berhasil');
      redirect('manage/payment');
    } else {
      if ($this->input->post('payment_id')) {
        redirect('manage/payment/edit/' . $this->input->post('payment_id'));
      }

            // Edit mode
      if (!is_null($id)) {
        $data['payment'] = $this->Payment_model->get(array('id' => $id));
      }
      $data['period'] = $this->Period_model->get();
      $data['pos'] = $this->Pos_model->get();
      $data['title'] = $data['operation'] . ' Jenis Pembayaran';
      $data['main'] = 'payment/payment_add';
      $this->load->view('manage/layout', $data);
    }
  }

  // View data detail
  public function view_bulan($id = NULL, $student_id = NULL) {

    if ($id == NULL) {
      redirect('manage/payment');
    }

    // Apply Filter
        // Get $_GET variable
    $q = $this->input->get(NULL, TRUE);

    $data['q'] = $q;
    $params = array();

        // Kelas
    if (isset($q['pr']) && !empty($q['pr']) && $q['pr'] != '') {
      $params['class_id'] = $q['pr'];
    }

    if (isset($q['k']) && !empty($q['k']) && $q['k'] != '') {
      $params['majors_id'] = $q['k'];
    }

    $params['payment_id'] = $id;
    $params['group'] = TRUE;
    $data['student_id'] = $student_id;

    $data['class'] = $this->Student_model->get_class($params);
    $data['majors'] = $this->Student_model->get_majors($params);
    $data['student'] = $this->Bulan_model->get($params);
    $data['payment'] = $this->Payment_model->get(array('id' => $id));
    $data['title'] = 'Tarif Pembayaran';
    $data['main'] = 'payment/payment_view_bulan';
    $this->load->view('manage/layout', $data);
  }

// View data detail
  public function view_bebas($id = NULL, $student_id = NULL, $bebas_id = NULL) {

    if ($id == NULL) {
      redirect('manage/payment');
    }

    // Apply Filter
        // Get $_GET variable
    $q = $this->input->get(NULL, TRUE);

    $data['q'] = $q;
    $params = array();

        // Kelas
    if (isset($q['pr']) && !empty($q['pr']) && $q['pr'] != '') {
      $params['class_id'] = $q['pr'];
    }

    if (isset($q['k']) && !empty($q['k']) && $q['k'] != '') {
      $params['majors_id'] = $q['k'];
    }

    $params['payment_id'] = $id;
    $params['group'] = TRUE;
    $data['student_id'] = $student_id;

    $data['class'] = $this->Student_model->get_class($params);
    $data['majors'] = $this->Student_model->get_majors($params);
    $data['student'] = $this->Bebas_model->get($params);
    $data['payment'] = $this->Payment_model->get(array('id' => $id));
    $data['title'] = 'Tarif Tagihan';
    $data['main'] = 'payment/payment_view_bebas';
    $this->load->view('manage/layout', $data);
  }

  // Delete payment Bebas
  public function delete_payment_bebas($id = NULL, $student_id = NULL, $bebas_id = NULL) {

      $bebas = $this->Bebas_pay_model->get(array(
        'bebas_id'=>$bebas_id
      ));

      if (count($bebas) > 0) {
        $this->session->set_flashdata('failed', 'Pembayaran Siswa tidak dapat dihapus');
        redirect('manage/payment/view_bebas/'.$id);
      }

      $this->Bebas_model->delete_bebas(array(
        'payment_id'=>$id,
        'student_id'=>$student_id,
        'id'=>$bebas_id
      ));
      
      $this->session->set_flashdata('success', 'Hapus Pembayaran Siswa berhasil');
      redirect('manage/payment/view_bebas/'.$id);
  }

  public function add_payment_bulan_student($id = NULL) {
    if ($id == NULL) {
      redirect('manage/payment');
    }

    $this->load->library('form_validation');

    $this->form_validation->set_rules('student_id', 'Pilih Kelas dan Siswa', 'trim|required|xss_clean');
    $this->form_validation->set_rules('bulan_bill[]', 'Tarif Bulanan', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if (!$this->input->post('payment_id')) { 

        $month = $this->Bulan_model->get_month();
        $check = $this->Bulan_model->get(array('student_id' =>$this->input->post('student_id'), 'payment_id'=> $id));
        $title = $_POST['bulan_bill'];
        $cpt = count($_POST['bulan_bill']);
        $month = $_POST['month_id'];
        for ($i = 0; $i < $cpt; $i++) {
          $param['bulan_bill'] = $title[$i];
          $param['month_id'] = $month[$i];
          $param['bulan_input_date'] = date('Y-m-d H:i:s');
          $param['bulan_last_update'] = date('Y-m-d H:i:s');
          $param['payment_id'] = $id;
          $param['student_id'] = $this->input->post('student_id');

          if (count($check) == 0) {

            $this->Bulan_model->add($param);
          } else {
            $this->session->set_flashdata('failed',' Duplikat Data');
            redirect('manage/payment/view_bulan/' . $id);
          }
        }
      }

      $this->session->set_flashdata('success',' Settig Tarif berhasil');
      redirect('manage/payment/view_bulan/' . $id);

    } else {
      $data['ngapp'] = 'ng-app="studentApp"';
      $data['student'] = $this->Student_model->get(array('status'=>1));
      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['month'] = $this->Bulan_model->get_month();
      $data['title'] = 'Tambah Tarif Pembayaran Siswa';
      $data['main'] = 'payment/payment_add_bulan_student';
      $this->load->view('manage/layout', $data);
    }
  }

  public function add_payment_bulan($id = NULL) {
    if ($id == NULL) {
      redirect('manage/payment');
    }
    $this->load->library('form_validation');

    $this->form_validation->set_rules('bulan_bill[]', 'Tarif Bulanan', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if (!$this->input->post('payment_id')) {

        $month = $this->Bulan_model->get_month();
        $student = $this->Student_model->get(array('class_id' => $this->input->post('class_id'),'status'=>1));
        $check = $this->Bulan_model->get(array('class_id' =>$this->input->post('class_id'), 'payment_id'=> $id));
        $title = $_POST['bulan_bill'];
        $cpt = count($_POST['bulan_bill']);
        $month = $_POST['month_id'];
        foreach ($student as $row) {
          for ($i = 0; $i < $cpt; $i++) {
            $param['bulan_bill'] = $title[$i];
            $param['month_id'] = $month[$i];
            $param['bulan_input_date'] = date('Y-m-d H:i:s');
            $param['bulan_last_update'] = date('Y-m-d H:i:s');
            $param['payment_id'] = $id;
            $param['student_id'] = $row['student_id'];
            
            if (count($check) == 0) {

              $this->Bulan_model->add($param);
            } else {
              $this->session->set_flashdata('failed',' Duplikat Data');
              redirect('manage/payment/view_bulan/' . $id);
            }
          }
        }
      }

      $this->session->set_flashdata('success',' Setting Tarif berhasil');
      redirect('manage/payment/view_bulan/' . $id);

    } else {

      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['month'] = $this->Bulan_model->get_month();
      $data['title'] = 'Tambah Tarif Pembayaran';
      $data['main'] = 'payment/payment_add_bulan';
      $this->load->view('manage/layout', $data);
    }
  }

  public function add_payment_bulan_majors($id = NULL) {
    if ($id == NULL) {
      redirect('manage/payment');
    }

    if (majors() != 'senior') {
      redirect('manage/payment/view_bulan/' . $id);
    }
    $this->load->library('form_validation');

    $this->form_validation->set_rules('bulan_bill[]', 'Tarif Bulanan', 'trim|required|xss_clean');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

    if ($_POST AND $this->form_validation->run() == TRUE) {

      if (!$this->input->post('payment_id')) {

        $month = $this->Bulan_model->get_month();
        $student = $this->Student_model->get(array('majors_id' => $this->input->post('majors_id'),'class_id' => $this->input->post('class_id'),'status'=>1));
        $check = $this->Bulan_model->get(array('majors_id' =>$this->input->post('majors_id'), 'class_id' =>$this->input->post('class_id'), 'payment_id'=> $id));
        $title = $_POST['bulan_bill'];
        $cpt = count($_POST['bulan_bill']);
        $month = $_POST['month_id'];
        foreach ($student as $row) {
          for ($i = 0; $i < $cpt; $i++) {
            $param['bulan_bill'] = $title[$i];
            $param['month_id'] = $month[$i];
            $param['bulan_input_date'] = date('Y-m-d H:i:s');
            $param['bulan_last_update'] = date('Y-m-d H:i:s');
            $param['payment_id'] = $id;
            $param['student_id'] = $row['student_id'];
            
            if (count($check) == 0) {

              $this->Bulan_model->add($param);
            } else {
              $this->session->set_flashdata('failed',' Duplikat Data');
              redirect('manage/payment/view_bulan/' . $id);
            }
          }
        }
      }

      $this->session->set_flashdata('success',' Setting Tarif berhasil');
      redirect('manage/payment/view_bulan/' . $id);

    } else {

      $data['majors'] = $this->Student_model->get_majors();
      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['month'] = $this->Bulan_model->get_month();
      $data['title'] = 'Tambah Tarif Pembayaran';
      $data['main'] = 'payment/payment_add_bulan_majors';
      $this->load->view('manage/layout', $data);
    }
  }

  public function edit_payment_bulan($id = NULL, $student_id = NULL) {
    if ($id == NULL AND $student_id == NULL OR $student_id ==NULL) {
      redirect('manage/payment');
    }

    if ($_POST  == TRUE) {

      $title = $_POST['bulan_bill'];
      $bulan_id = $_POST['bulan_id'];
      $cpt = count($_POST['bulan_bill']);

      for ($i = 0; $i < $cpt; $i++) {
        $param['bulan_id'] = $bulan_id[$i];
        $param['bulan_bill'] = $title[$i];
        $param['bulan_last_update'] = date('Y-m-d H:i:s');

        $this->Bulan_model->add($param); 
      }

      $this->session->set_flashdata('success',' Pembayaran berhasil');
      redirect('manage/payment/view_bulan/' . $id);

    } else {

      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['bulan'] = $this->Bulan_model->get(array('payment_id' => $id, 'student_id' => $student_id));
      $data['student'] = $this->Student_model->get(array('id'=> $student_id));
      $data['title'] = 'Edit Tarif Pembayaran';
      $data['main'] = 'payment/payment_edit_bulan';
      $this->load->view('manage/layout', $data);
    }
  }

  public function delete_payment_bulan($id = NULL, $student_id = NULL) {
    if ($id == NULL AND $student_id == NULL OR $student_id ==NULL) {
      redirect('manage/payment');
    }

      $bulan_id = $kk;
      $cpt = count($_POST['bulan_id']);

      for ($i = 0; $i < $cpt; $i++) {
        $param['bulan_id'] = $bulan_id[$i];

        $this->Bulan_model->delete($param); 
      }

      $this->session->set_flashdata('success',' Pembayaran berhasil');
      redirect('manage/payment/view_bulan/' . $id);

    }

  public function add_payment_bebas_student($id = NULL) {
    if ($id == NULL) {
      redirect('manage/payment');
    }

    if ($_POST  == TRUE) {

      if (!$this->input->post('payment_id')) {

        $student = $this->Student_model->get(array('student_id' => $this->input->post('student_id')));
        $check = $this->Bebas_model->get(array('student_id' =>$this->input->post('student_id'), 'payment_id'=> $id));
        
        foreach ($student as $row) {
          $param['bebas_bill'] = $this->input->post('bebas_bill');
          $param['bebas_input_date'] = date('Y-m-d H:i:s');
          $param['bebas_last_update'] = date('Y-m-d H:i:s');
          $param['payment_id'] = $id;
          $param['student_id'] = $this->input->post('student_id');

          if (count($check) == 0) {

            $this->Bebas_model->add($param);
          } else {
            $this->session->set_flashdata('failed',' Duplikat Data');
            redirect('manage/payment/view_bebas/' . $id);
          }
        }
      }

      $this->session->set_flashdata('success',' Setting Tarif berhasil');
      redirect('manage/payment/view_bebas/' . $id);

    } else {
      $data['ngapp'] = 'ng-app="studentApp"';
      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['title'] = 'Tambah Tarif Pembayaran';
      $data['main'] = 'payment/payment_add_bebas_student';
      $this->load->view('manage/layout', $data);
    }
  }

  public function add_payment_bebas($id = NULL) {
    if ($id == NULL) {
      redirect('manage/payment');
    }

    if ($_POST  == TRUE) {

      if (!$this->input->post('payment_id')) {

        $student = $this->Student_model->get(array('class_id' => $this->input->post('class_id')));
        $check = $this->Bebas_model->get(array('class_id' =>$this->input->post('class_id'), 'payment_id'=> $id));
        
        foreach ($student as $row) {
          $param['bebas_bill'] = $this->input->post('bebas_bill');
          $param['bebas_input_date'] = date('Y-m-d H:i:s');
          $param['bebas_last_update'] = date('Y-m-d H:i:s');
          $param['payment_id'] = $id;
          $param['student_id'] = $row['student_id'];

          if (count($check) == 0) {

            $this->Bebas_model->add($param);
          } else {
            $this->session->set_flashdata('failed',' Duplikat Data');
            redirect('manage/payment/view_bebas/' . $id);
          }
        }
      }

      $this->session->set_flashdata('success',' Setting Tarif berhasil');
      redirect('manage/payment/view_bebas/' . $id);

    } else {

      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['title'] = 'Tambah Tarif Pembayaran';
      $data['main'] = 'payment/payment_add_bebas';
      $this->load->view('manage/layout', $data);
    }
  }

  public function add_payment_bebas_majors($id = NULL) {
    if ($id == NULL) {
      redirect('manage/payment');
    }

    if(majors() != 'senior') {
      redirect('manage/payment/view_bebas/' . $id);
    }

    if ($_POST  == TRUE) {

      if (!$this->input->post('payment_id')) {

        $student = $this->Student_model->get(array('majors_id' => $this->input->post('majors_id'),'class_id' => $this->input->post('class_id')));
        $check = $this->Bebas_model->get(array('majors_id' =>$this->input->post('majors_id'),'class_id' => $this->input->post('class_id'), 'payment_id'=> $id));
        
        foreach ($student as $row) {
          $param['bebas_bill'] = $this->input->post('bebas_bill');
          $param['bebas_input_date'] = date('Y-m-d H:i:s');
          $param['bebas_last_update'] = date('Y-m-d H:i:s');
          $param['payment_id'] = $id;
          $param['student_id'] = $row['student_id'];

          if (count($check) == 0) {

            $this->Bebas_model->add($param);
          } else {
            $this->session->set_flashdata('failed',' Duplikat Data');
            redirect('manage/payment/view_bebas/' . $id);
          }
        }
      }

      $this->session->set_flashdata('success',' Setting Tarif berhasil');
      redirect('manage/payment/view_bebas/' . $id);

    } else {

      $data['majors'] = $this->Student_model->get_majors();
      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['title'] = 'Tambah Tarif Pembayaran';
      $data['main'] = 'payment/payment_add_bebas_majors';
      $this->load->view('manage/layout', $data);
    }
  }

  public function edit_payment_bebas($id = NULL, $student_id = NULL, $bebas_id = NULL) {
    if ($id == NULL AND $student_id == NULL OR $bebas_id == NULL) {
      redirect('manage/payment');
    }

    if ($_POST  == TRUE) {

      $param['bebas_id'] = $bebas_id;
      $param['bebas_bill'] = $this->input->post('bebas_bill');
      $param['bulan_last_update'] = date('Y-m-d H:i:s');

      $this->Bebas_model->add($param); 

      $this->session->set_flashdata('success',' Update Tagihan berhasil');
      redirect('manage/payment/view_bebas/' . $id);

    } else {

      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['bebas'] = $this->Bebas_model->get(array('payment_id' => $id, 'student_id' => $student_id));

      $data['student'] = $this->Student_model->get(array('id'=> $student_id));
      $data['title'] = 'Edit Tarif Tagihan';
      $data['main'] = 'payment/payment_edit_bebas';
      $this->load->view('manage/layout', $data);
    }
  }


    // Delete to database
  public function delete($id = NULL) {
   if ($this->session->userdata('uroleid')!= SUPERUSER){
    redirect('manage');
  }
  if ($_POST) {

    $bulan = $this->Bulan_model->get(array('payment_id' => $this->input->post('payment_id')));
    $bebas = $this->Bebas_model->get(array('payment_id' => $this->input->post('payment_id')));

    if (count($bulan)>0) {
      $this->session->set_flashdata('failed', 'Pembayaran tidak dapat dihapus');
      redirect('manage/payment');
    } else if (count($bebas)>0) {
      $this->session->set_flashdata('failed', 'Pembayaran tidak dapat dihapus');
      redirect('manage/payment');
    }

    $this->Payment_model->delete($this->input->post('payment_id'));
            // activity log
    $this->load->model('logs/Logs_model');
    $this->Logs_model->add(
      array(
        'log_date' => date('Y-m-d H:i:s'),
        'user_id' => $this->session->userdata('uid'),
        'log_module' => 'Jenis Pembayaran',
        'log_action' => 'Hapus',
        'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
      )
    );
    $this->session->set_flashdata('success', 'Hapus Jenis Pembayaran berhasil');
    redirect('manage/payment');
  } elseif (!$_POST) {
    $this->session->set_flashdata('delete', 'Delete');
    redirect('manage/payment/edit/' . $id);
  }
}

}