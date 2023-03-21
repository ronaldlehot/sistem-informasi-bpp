<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Payout_set extends CI_Controller {

  public function __construct() {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged') == NULL) {
      header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('payment/Payment_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'setting/Setting_model', 'letter/Letter_model', 'logs/Logs_model', 'ltrx/Log_trx_model'));

  }

// payment view in list
  public function index($offset = NULL, $id =NULL) {
// Apply Filter
// Get $_GET variable
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $siswa['student_id'] = '';
    $params = array();
    $param = array();
    $pay = array();
    $cashback = array();
    $logs = array();

// Tahun Ajaran
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['period_id'] = $f['n'];
      $pay['period_id'] = $f['n'];
      $cashback['period_id'] = $f['n'];
      $logs['period_id'] = $f['n'];
    }

// Siswa
    if (isset($f['r']) && !empty($f['r']) && $f['r'] != '') {
      $params['student_nis'] = $f['r'];
      $param['student_nis'] = $f['r'];
      $cashback['student_nis'] = $f['r'];
      $logs['student_nis'] = $f['r'];
      $siswa = $this->Student_model->get(array('student_nis'=>$f['r']));
    }

    // tanggal
    if (isset($f['d']) && !empty($f['d']) && $f['d'] != '') {
      $param['date'] = $f['d'];

    }


    $params['group'] = TRUE;
    $pay['paymentt'] = TRUE;
    $param['status'] = 1;
    $cashback['status'] = 1;
    $pay['student_id']=$siswa['student_id'];
    $cashback['student_id']=$siswa['student_id'];
    $logs['student_id']=$siswa['student_id'];
    $cashback['date'] = date('Y-m-d');
    $cashback['bebas_pay_input_date'] = date('Y-m-d');
    $logs['limit'] = 3;


    $paramsPage = $params;
    $data['period'] = $this->Period_model->get($params);
    $data['siswa'] = $this->Student_model->get(array('student_id'=>$siswa['student_id'], 'group'=>TRUE));
    $data['student'] = $this->Bulan_model->get($pay);
    $data['bulan'] = $this->Bulan_model->get(array('student_id'=>$siswa['student_id']));
    $data['bebas'] = $this->Bebas_model->get($pay);
    $data['free'] = $this->Bebas_pay_model->get($params);
    $data['dom'] = $this->Bebas_pay_model->get($params);
    $data['bill'] = $this->Bulan_model->get_total($params);
    $data['in'] = $this->Bulan_model->get_total($param);
    $data['month'] = $this->Bulan_model->get_total($cashback);
    $data['beb'] = $this->Bebas_pay_model->get($cashback);
    $data['log'] = $this->Log_trx_model->get($logs);

    // cashback
    $data['cash'] = 0;
    foreach ($data['month'] as $row) {
      $data['cash'] += $row['bulan_bill'];
    }

    $data['cashb'] = 0;
    foreach ($data['beb'] as $row) {
      $data['cashb'] += $row['bebas_pay_bill'];
    }

    // endcashback


    // 
    $data['total'] = 0;
    foreach ($data['bill'] as $key) {
      $data['total'] += $key['bulan_bill'];
    }

    $data['pay'] = 0;
    foreach ($data['in'] as $row) {
      $data['pay'] += $row['bulan_bill'];
    }

    $data['pay_bill'] = 0;
    foreach ($data['dom'] as $row) {
      $data['pay_bill'] += $row['bebas_pay_bill'];
    }

    $config['base_url'] = site_url('manage/payment/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Bulan_model->get($paramsPage));

    $data['title'] = 'Pembayaran Siswa';
    $data['main'] = 'payout/payout_list';
    $this->load->view('manage/layout', $data);
  } 

  function printBill() {
    $this->load->helper(array('dompdf'));
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $siswa['student_id'] = '';
    $params = array();
    $pay = array();

// Tahun Ajaran
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['period_id'] = $f['n'];
      $pay['period_id'] = $f['n'];
    }

// Siswa
    if (isset($f['r']) && !empty($f['r']) && $f['r'] != '') {
      $params['student_nis'] = $f['r'];
      $siswa = $this->Student_model->get(array('student_nis'=>$f['r']));

    }

    $pay['student_id']=$siswa['student_id'];

    $data['period'] = $this->Period_model->get($params);
    $data['siswa'] = $this->Student_model->get(array('student_id'=>$siswa['student_id'], 'group'=>TRUE));
    $data['bulan'] = $this->Bulan_model->get($pay);
    $data['bebas'] = $this->Bebas_model->get($pay);

    $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT)); 

    $html = $this->load->view('payout/payout_bill_pdf', $data, true);
    $data = pdf_create($html, $siswa['student_full_name'], TRUE, 'A4', TRUE);
  }

  function cetakBukti() {
    $this->load->helper(array('dompdf'));
    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $siswa['student_id'] = '';
    $params = array();
    $param = array();
    $pay = array();
    $cashback = array();

// Tahun Ajaran
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['period_id'] = $f['n'];
      $pay['period_id'] = $f['n'];
      $cashback['period_id'] = $f['n'];
    }

// Siswa
    if (isset($f['r']) && !empty($f['r']) && $f['r'] != '') {
      $params['student_nis'] = $f['r'];
      $param['student_nis'] = $f['r'];
      $siswa = $this->Student_model->get(array('student_nis'=>$f['r']));

    }

    // tanggal
    if (isset($f['d']) && !empty($f['d']) && $f['d'] != '') {
      $param['date'] = $f['d'];
      $cashback['date'] = $f['d'];

    }


    $params['group'] = TRUE;
    $pay['paymentt'] = TRUE;
    $param['status'] = 1;
    $param['student_id']=$siswa['student_id'];
    $cashback['status'] = 1;
    $pay['student_id']=$siswa['student_id'];
    $cashback['student_id']=$siswa['student_id'];

    $data['period'] = $this->Period_model->get($params);
    $data['siswa'] = $this->Student_model->get(array('student_id'=>$siswa['student_id'], 'group'=>TRUE));
    $data['student'] = $this->Bulan_model->get($pay);
    $data['bulan'] = $this->Bulan_model->get($param);
    $data['bebas'] = $this->Bebas_model->get($pay);
    $data['free'] = $this->Bebas_pay_model->get($param);
    $data['s_bl'] = $this->Bulan_model->get_total($cashback);
    $data['s_bb'] = $this->Bebas_pay_model->get($cashback);

    //total
    $data['summonth'] = 0;
    foreach ($data['s_bl'] as $row) {
      $data['summonth'] += $row['bulan_bill'];
    }

    $data['sumbeb'] = 0;
    foreach ($data['s_bb'] as $row) {
      $data['sumbeb'] += $row['bebas_pay_bill'];
    }
    // endtotal

    $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT)); 
    $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME)); 
    $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS)); 
    $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE)); 

    $html = $this->load->view('payout/payout_cetak_pdf', $data, true);
    $data = pdf_create($html, 'Cetak_Struk_'.$siswa['student_full_name'].'_'.date('Y-m-d'), TRUE, 'A4', TRUE);
  }



// View data detail
  public function view_bulan($id = NULL) {

// Apply Filter
// Get $_GET variable
    $q = $this->input->get(NULL, TRUE); 

    $data['q'] = $q;
    $params = array();

// Programs
    if (isset($q['pr']) && !empty($q['pr']) && $q['pr'] != '') {
      $params['class_id'] = $q['pr'];
    }

    $data['class'] = $this->Student_model->get_class($params);
    $data['student'] = $this->Student_model->get($params);
    $data['payment'] = $this->Payment_model->get(array('id' => $id));
    $data['bulan'] = $this->Bulan_model->get(array('id' => $id));
    $data['title'] = 'Tarif Pembayaran';
    $data['main'] = 'payment/payment_view_bulan';
    $this->load->view('manage/layout', $data);
  }

// View data detail
  public function view_bebas($id = NULL) {

    $data['payment'] = $this->Payment_model->get(array('id' => $id));
    $data['bebas'] = $this->Bebas_model->get(array('id' => $id));
    $data['title'] = 'Tarif Pembayaran';
    $data['main'] = 'payment/payment_view_bebas';
    $this->load->view('manage/layout', $data);
  }


  public function payout_bulan($id = NULL, $student_id = NULL) {

    if ($id == NULL AND $student_id == NULL OR $student_id == NULL) {
      redirect('manage/payout');
    }

    $data['class'] = $this->Student_model->get_class();
    $data['payment'] = $this->Payment_model->get(array('id' => $id));
    $data['bulan'] = $this->Bulan_model->get(array('payment_id' => $id, 'student_id' => $student_id));
    $data['in'] = $this->Bulan_model->get_total(array('status'=>1, 'payment_id' => $id, 'student_id' => $student_id));
    $data['student'] = $this->Student_model->get(array('id'=> $student_id));

    $data['total'] = 0;
    foreach ($data['bulan'] as $key) {
      $data['total'] += $key['bulan_bill'];
    }

    $data['pay'] = 0;
    foreach ($data['in'] as $row) {
      $data['pay'] += $row['bulan_bill'];
    }

    $data['ngapp'] = 'ng-app="App"';
    $data['title'] = 'Pembayaran Siswa';
    $data['main'] = 'payout/payout_add_bulan';
    $this->load->view('manage/layout', $data);
  }

  public function payout_bebas($id = NULL, $student_id = NULL, $bebas_id = NULL, $pay_id =NULL) {

    // if ($id == NULL AND $student_id == NULL AND $bebas_id == NULL OR $bebas_id == NULL) {
    //   redirect('manage/payout');
    // }
    if ($_POST == TRUE) {


      $lastletter = $this->Letter_model->get(array('limit' => 1));
      $student = $this->Bebas_model->get(array('id'=>$this->input->post('bebas_id')));
      $user = $this->Setting_model->get(array('id' => 8));
      $password = $this->Setting_model->get(array('id' => 9));
      $activated = $this->Setting_model->get(array('id' => 10));

      if ($lastletter['letter_year'] < date('Y') OR count($lastletter) == 0) {
        $this->Letter_model->add(array('letter_number' => '00001', 'letter_month' => date('m'), 'letter_year' => date('Y')));
        $nomor = sprintf('%05d', '00001');
        $nofull = date('Y'). date('m'). $nomor;
      } else {
        $nomor = sprintf('%05d', $lastletter['letter_number'] + 00001);
        $this->Letter_model->add(array('letter_number' => $nomor, 'letter_month' => date('m'), 'letter_year' => date('Y')));
        $nofull = date('Y'). date('m'). $nomor;
      }
      if ($this->input->post('bebas_id')) {
        $param['bebas_id'] = $this->input->post('bebas_id');
      } 
      $param['bebas_pay_number'] = $nofull;
      $param['bebas_pay_bill'] = $this->input->post('bebas_pay_bill');
      $param['increase_budget'] = $this->input->post('bebas_pay_bill');
      $param['bebas_pay_desc'] = $this->input->post('bebas_pay_desc');
      $param['user_user_id'] = $this->session->userdata('uid');
      $param['bebas_pay_input_date'] = date('Y-m-d H:i:s');
      $param['bebas_pay_last_update'] = date('Y-m-d H:i:s');

      

      $data['bill'] = $this->Bebas_pay_model->get(array('bebas_id'=>$this->input->post('bebas_id')));
      $data['bebas'] = $this->Bebas_model->get(array('payment_id' => $this->input->post('payment_payment_id'), 'student_nis' => $this->input->post('student_nis')));

      $data['total'] = 0;
      foreach ($data['bebas'] as $key) {
        $data['total'] += $key['bebas_bill'];
      }

      $data['total_pay'] = 0;
      foreach ($data['bill'] as $row) {
        $data['total_pay'] += $row['bebas_pay_bill'];
      }

      $sisa = $data['total'] - $data['total_pay'];


      if ($this->input->post('bebas_pay_bill') > $sisa OR $this->input->post('bebas_pay_bill') == 0) {
        $this->session->set_flashdata('failed',' Pembayaran yang anda masukkan melebihi total tagihan!!!');
        redirect('manage/payout?n='.$student['period_period_id'].'&r='.$student['student_nis']);
      } else {

        $idd = $this->Bebas_pay_model->add($param);

        $this->Bebas_model->add(array('increase_budget' => $this->input->post('bebas_pay_bill'), 'bebas_id' =>  $this->input->post('bebas_id'), 'bebas_last_update'=>date('Y-m-d H:i:s'))); 
        
        $log = array(
          'bulan_bulan_id' => NULL,
          'bebas_pay_bebas_pay_id' => $idd,
          'student_student_id' => $this->input->post('student_student_id'),
          'log_trx_input_date' =>  date('Y-m-d H:i:s'),
          'log_trx_last_update' => date('Y-m-d H:i:s'),
        );
        $this->Log_trx_model->add($log);
      }

      if ($activated['setting_value'] == 'Y') {

        $userkey = $user['setting_value']; 
        $passkey = $password['setting_value']; 
        $telepon = $student['student_parent_phone'];
        $message = "Pembayaran ".$student['pos_name'].' - T.A '.$student['period_start'].'/'.$student['period_end'].'-'.$this->input->post('bebas_pay_desc').' a/n '.$student['student_full_name'].' Berhasil';
        $url = "https://reguler.zenziva.net/apps/smsapi.php";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        curl_close($curlHandle);
      }

      $this->session->set_flashdata('success',' Pembayaran Tagihan berhasil');
      redirect('manage/payout?n='.$student['period_period_id'].'&r='.$student['student_nis']);

    } else {

      $data['class'] = $this->Student_model->get_class();
      $data['payment'] = $this->Payment_model->get(array('id' => $id));
      $data['bebas'] = $this->Bebas_model->get(array('payment_id' => $id, 'student_id' => $student_id));
      $data['student'] = $this->Student_model->get(array('id'=> $student_id));
      $data['bill'] = $this->Bebas_pay_model->get(array('bebas_id'=>$bebas_id, 'student_id'=>$student_id, 'payment_id'=>$id));

      $data['total'] = 0;
      foreach ($data['bebas'] as $key) {
        $data['total'] += $key['bebas_bill'];
      }

      $data['total_pay'] = 0;
      foreach ($data['bill'] as $row) {
        $data['total_pay'] += $row['bebas_pay_bill'];
      }

      $data['title'] = 'Tagihan Siswa';
      // $data['main'] = 'payout/payout_add_bebas';
      $this->load->view('payout/payout_add_bebas', $data);

    }
  }


  function pay($payment_id = NULL, $student_id =NULL, $id = NULL) { 

    $lastletter = $this->Letter_model->get(array('limit' => 1));
    $student = $this->Bulan_model->get(array('student_id'=>$student_id,'id'=>$id));
    $user = $this->Setting_model->get(array('id' => 8));
    $password = $this->Setting_model->get(array('id' => 9));
    $activated = $this->Setting_model->get(array('id' => 10));

    if ($lastletter['letter_year'] < date('Y') OR count($lastletter) == 0) {
      $this->Letter_model->add(array('letter_number' => '00001', 'letter_month' => date('m'), 'letter_year' => date('Y')));
      $nomor = sprintf('%05d', '00001');
      $nofull = date('Y'). date('m'). $nomor;
    } else {
      $nomor = sprintf('%05d', $lastletter['letter_number'] + 00001);
      $this->Letter_model->add(array('letter_number' => $nomor, 'letter_month' => date('m'), 'letter_year' => date('Y')));
      $nofull = date('Y'). date('m'). $nomor;
    }


    $pay = array(
      'bulan_id' => $id,
      'bulan_number_pay' => $nofull,
      'bulan_date_pay' => date('Y-m-d H:i:s'),
      'bulan_last_update' => date('Y-m-d H:i:s'),
      'bulan_status' => 1,
      'user_user_id' => $this->session->userdata('uid')
    );

    $log = array(
      'bulan_bulan_id' => $id,
      'student_student_id' => $student_id,
      'bebas_pay_bebas_pay_id' => NULL,
      'log_trx_input_date' =>  date('Y-m-d H:i:s'),
      'log_trx_last_update' => date('Y-m-d H:i:s'),
    );


    $status = $this->Bulan_model->add($pay);

    $this->Log_trx_model->add($log);

    if ($activated['setting_value'] == 'Y') {

      $userkey = $user['setting_value']; 
      $passkey = $password['setting_value']; 
      $telepon = $student['student_parent_phone'];

      $namePay = $student['pos_name'].' - T.A '.$student['period_start'].'/'.$student['period_end'];
      $mont = ($student['month_month_id']<=6) ? $student['period_start'] : $student['period_end'];

      $message = "Pembayaran ".$namePay.' - ('.$student['month_name'].' '. $mont.') a/n '.$student['student_full_name'].' Berhasil';

      $url = "https://reguler.zenziva.net/apps/smsapi.php";
      $curlHandle = curl_init();
      curl_setopt($curlHandle, CURLOPT_URL, $url);
      curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
      curl_setopt($curlHandle, CURLOPT_HEADER, 0);
      curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
      curl_setopt($curlHandle, CURLOPT_POST, 1);
      $results = curl_exec($curlHandle);
      curl_close($curlHandle);
    }


    if ($this->input->is_ajax_request()) {
      echo $status;
    } else {
      $this->session->set_flashdata('success', 'Pembayaran Berhasil');
      redirect('manage/payout?n='.$student['period_period_id'].'&r='.$student['student_nis']);
    }
  }

  function not_pay($payment_id = NULL, $student_id =NULL, $id = NULL) { 
    $student = $this->Bulan_model->get(array('student_id'=>$student_id,'id'=>$id));
    $pay = array(
      'bulan_id' => $id,
      'bulan_number_pay' => NULL,
      'bulan_status' => 0,
      'bulan_date_pay' => NULL,
      'bulan_last_update' => date('Y-m-d H:i:s'),
      'user_user_id' => NULL
    );

    
    $this->Log_trx_model->delete_log(array(
      'student_id' => $student_id,
      'bulan_id' => $id
    ));



    $this->Bulan_model->add($pay);
    if ($this->input->is_ajax_request()) {
      echo $status;
    } else {
      $this->session->set_flashdata('success', 'Hapus Pembayaran Berhasil');
      redirect('manage/payout?n='.$student['period_period_id'].'&r='.$student['student_nis']);
    }
  }

  function printPay($payment_id = NULL, $student_id =NULL, $id = NULL) {
    $this->load->helper(array('dompdf'));
    $this->load->helper(array('tanggal'));

    if ($id == NULL)
      redirect('manage/payout/payout_bulan/'.$payment_id.'/'.$student_id);

    $data['printpay'] = $this->Bulan_model->get(array('id' =>$id));

    $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));
    $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS));
    $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE)); 
    $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT));
    $data['setting_city'] = $this->Setting_model->get(array('id' => SCHOOL_CITY)); 

    $html = $this->load->view('payout/payout_pdf', $data, true);
    $data = pdf_create($html, $data['printpay']['student_full_name'], TRUE, 'A4', TRUE);
  }

  function printPayFree($payment_id = NULL, $student_id =NULL, $id = NULL) {
    $this->load->helper(array('dompdf'));
    $this->load->helper(array('tanggal'));

    if ($id == NULL)
      redirect('manage/payout/payout_bebas/'.$payment_id.'/'.$student_id);

    $data['printpay'] = $this->Bebas_pay_model->get(array('id' =>$id));

    $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));
    $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS));
    $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE));
    $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT));
    $data['setting_city'] = $this->Setting_model->get(array('id' => SCHOOL_CITY));  
    $data['bebas'] = $this->Bebas_model->get(array('payment_id' => $payment_id, 'student_id' => $student_id));

    $data['total_bill'] = 0;
    foreach ($data['bebas'] as $key) {
      $data['total_bill'] += $key['bebas_total_pay'];
    }

    $data['bill'] = 0;
    foreach ($data['bebas'] as $key) {
      $data['bill'] += $key['bebas_bill'];
    }

    $html = $this->load->view('payout/payout_free_pdf', $data, true);
    $data = pdf_create($html, $data['printpay']['student_full_name'], TRUE, 'A4', TRUE);
  }

  function multiple() {
    $this->load->helper(array('dompdf'));
    $this->load->helper(array('tanggal'));
    $action = $this->input->post('action');
    $print = array();
    if ($action == "printAll") {
      $bln = $this->input->post('msg');
      for ($i = 0; $i < count($bln); $i++) {
        $print[] = $bln[$i];
      }

      $data['printpay'] = $this->Bulan_model->get(array('multiple_id' => $print, 'group'=>TRUE));
      $data['pay'] = $this->Bulan_model->get(array('multiple_id' => $print));

      $data['total_pay'] = 0;
      foreach ($data['pay'] as $row) {
        $data['total_pay'] += $row['bulan_bill'];
      }

      $data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));
      $data['setting_address'] = $this->Setting_model->get(array('id' => SCHOOL_ADRESS));
      $data['setting_phone'] = $this->Setting_model->get(array('id' => SCHOOL_PHONE));
      $data['setting_district'] = $this->Setting_model->get(array('id' => SCHOOL_DISTRICT));
      $data['setting_city'] = $this->Setting_model->get(array('id' => SCHOOL_CITY)); 

      $html = $this->load->view('payout/payout_bulan_multiple_pdf', $data, true);
      $data = pdf_create($html, 'Tagihan_Pembayaran_'.date('d_m_Y'), TRUE, 'A4', TRUE);

    } 
    redirect('manage/payout');
  }

  function delete_pay_free($payment_id = NULL, $student_id =NULL, $bebas_id = NULL, $id =NULL) {

    $total_pay = $this->Bebas_pay_model->get(array('id'=>$id));

    $this->Bebas_model->add(
      array(
        'decrease_budget'=> $total_pay['bebas_pay_bill'],
        'bebas_id'=>$bebas_id
      )
    );

    $this->Log_trx_model->delete_log(array(
      'student_id' => $student_id,
      'bebas_pay_id' => $id
    ));

    $this->Bebas_pay_model->delete($id);

    if ($this->input->is_ajax_request()) {
      echo $status;
    } else {
      $this->session->set_flashdata('success', 'Delete Berhasil');
      redirect('manage/payout/payout_bebas/' . $payment_id.'/'.$student_id.'/'.$bebas_id);
    }
    
  }

// Delete to database
  public function delete($id = NULL) {
    if ($this->session->userdata('uroleid')!= SUPERUSER){
      redirect('manage');
    }
    if ($_POST) {
      $this->Payment_model->delete($id);
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
      $this->session->set_flashdata('success', 'Hapus Jenis Pembayran berhasil');
      redirect('manage/payment');
    } elseif (!$_POST) {
      $this->session->set_flashdata('delete', 'Delete');
      redirect('manage/payment/edit/' . $id);
    }
  }


}