<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_student extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('student/Student_model');
        $this->load->model('setting/Setting_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }

    function index() {
        redirect('student/auth/login');
    }

    function login() {
        if ($this->session->userdata('logged_student')) {
            redirect('student');
        }
        if ($this->input->post('location')) {
            $location = $this->input->post('location');
        } else {
            $location = NULL;
        }
        $this->form_validation->set_rules('nis', 'NIS', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $nis = $this->input->post('nis', TRUE);
            $password = $this->input->post('password', TRUE);

            $student = $this->Student_model->get(array('nis' => $nis, 'password' => sha1($password)));

            if (count($student) > 0) {
                $this->session->set_userdata('logged_student', TRUE);
                $this->session->set_userdata('uid_student', $student[0]['student_id']);
                $this->session->set_userdata('unis_student', $student[0]['student_nis']);
                $this->session->set_userdata('ufullname_student', $student[0]['student_full_name']);
                $this->session->set_userdata('student_img', $student[0]['student_img']);
                if ($location != '') {
                    header("Location:" . htmlspecialchars($location));
                } else {
                    redirect('student');
                }
            } else {
                if ($location != '') {
                    $this->session->set_flashdata('failed', 'Maaf, NIS dan password tidak cocok!');
                    header("Location:" . site_url('student/auth/login') . "?location=" . urlencode($location));
                } else {
                    $this->session->set_flashdata('failed', 'Maaf, NIS dan password tidak cocok!');
                    redirect('student/auth/login');
                }
            }
        } else {
            $data['setting_school'] = $this->Setting_model->get(array('id'=>1));
            $data['setting_logo'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO));
            $this->load->view('student/login', $data);
        }
    }

    // Logout Processing
    function logout() {
        $this->session->unset_userdata('logged_student');
        $this->session->unset_userdata('uid_student');
        $this->session->unset_userdata('unis_student');
        $this->session->unset_userdata('ufullname_student');
        $this->session->unset_userdata('student_img');

        $q = $this->input->get(NULL, TRUE);
        if ($q['location'] != NULL) {
            $location = $q['location'];
        } else {
            $location = NULL;
        }
        header("Location:" . $location);
    }

}
