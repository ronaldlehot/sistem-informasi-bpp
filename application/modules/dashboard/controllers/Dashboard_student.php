<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_student') == NULL) {
            header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('student/Student_model', 'bulan/Bulan_model', 'setting/Setting_model','bebas/Bebas_model', 'information/Information_model', 'bebas/Bebas_pay_model'));
    }

    public function index() {
        $id = $this->session->userdata('uid'); 

        $data['information'] = $this->Information_model->get(array('information_publish'=>1));
        $data['bulan'] = $this->Bulan_model->get(array('status'=>0, 'period_status'=>1, 'student_id'=> $this->session->userdata('uid_student')));
        $data['bebas'] = $this->Bebas_model->get(array('period_status'=>1, 'student_id'=> $this->session->userdata('uid_student')));

        $data['total_bulan'] =0;
        foreach ($data['bulan'] as $row) {
            $data['total_bulan'] += $row['bulan_bill'];
        }

        $data['total_bebas'] =0;
        foreach ($data['bebas'] as $row) {
            $data['total_bebas'] += $row['bebas_bill'];
        }

        $data['total_bebas_pay'] =0;
        foreach ($data['bebas'] as $row) {
            $data['total_bebas_pay'] += $row['bebas_total_pay'];
        }



        $data['title'] = 'Dashboard';
        $data['main'] = 'dashboard/dashboard_student';
        $this->load->view('student/layout', $data);
    }


}
