<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Payout_student extends CI_Controller {

  public function __construct() {
    parent::__construct(TRUE);
    if ($this->session->userdata('logged_student') == NULL) {
      header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
    }
    $this->load->model(array('payment/Payment_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'setting/Setting_model', 'letter/Letter_model', 'logs/Logs_model'));

  }


  public function index($offset = NULL) {

    $f = $this->input->get(NULL, TRUE);

    $data['f'] = $f;

    $siswa['student_id'] = '';
    $params = array();
    $param = array();
    $pay = array();

// Tahun Ajaran
    if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
      $params['period_id'] = $f['n'];
      $pay['period_id'] = $f['n'];
    }

// Siswa
    if (isset($f['r']) && !empty($f['r']) && $f['r'] != '') {
      $params['student_nis'] = $f['r'];
      $param['student_nis'] = $f['r'];
      $siswa = $this->Student_model->get(array('student_nis'=>$f['r']));

    }


    $params['group'] = TRUE;
    $pay['paymentt'] = TRUE;
    $param['status'] = 1;
    $pay['student_id']=$siswa['student_id'];


    $paramsPage = $params;
    $data['period'] = $this->Period_model->get($params);
    $data['siswa'] = $this->Student_model->get(array('student_id'=>$siswa['student_id'], 'group'=>TRUE));
    $data['student'] = $this->Bulan_model->get($pay);
    $data['bebas'] = $this->Bebas_model->get($pay);
    $data['free'] = $this->Bebas_pay_model->get($params);
    $data['dom'] = $this->Bebas_pay_model->get($params);
    $data['bill'] = $this->Bulan_model->get_total($params);
    $data['in'] = $this->Bulan_model->get_total($param);

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

    $config['base_url'] = site_url('student/payment/index');
    $config['suffix'] = '?' . http_build_query($_GET, '', "&");
    $config['total_rows'] = count($this->Bulan_model->get($paramsPage));

    $data['title'] = 'Cek Pembayaran Siswa';
    $data['main'] = 'payout/payout_student_list';
    $this->load->view('student/layout', $data);
  }
}