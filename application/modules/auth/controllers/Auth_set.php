<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_set extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users/Users_model');
        $this->load->model('setting/Setting_model');
        $this->load->library('form_validation');
        $this->load->helper('string');
    }

    function index() {
        redirect('manage/auth/login');
    }

    function login() {
        if ($this->session->userdata('logged')) {
            redirect('manage');
        }
        if ($this->input->post('location')) {
            $location = $this->input->post('location');
        } else {
            $location = NULL;
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->Users_model->get(array('email' => $email, 'password' => sha1($password)));

            if (count($user) > 0) {
                $this->session->set_userdata('logged', TRUE);
                $this->session->set_userdata('uid', $user[0]['user_id']);
                $this->session->set_userdata('uemail', $user[0]['user_email']);
                $this->session->set_userdata('ufullname', $user[0]['user_full_name']);
                $this->session->set_userdata('uroleid', $user[0]['user_role_role_id']);
                $this->session->set_userdata('urolename', $user[0]['role_name']);
                $this->session->set_userdata('user_image', $user[0]['user_image']);
                if ($location != '') {
                    header("Location:" . htmlspecialchars($location));
                } else {
                    redirect('manage');
                }
            } else {
                if ($location != '') {
                    $this->session->set_flashdata('failed', 'Maaf, username dan password tidak cocok!');
                    header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($location));
                } else {
                    $this->session->set_flashdata('failed', 'Maaf, username dan password tidak cocok!');
                    redirect('manage/auth/login');
                }
            }
        } else {
            $data['setting_school'] = $this->Setting_model->get(array('id'=>1));
            $data['setting_logo'] = $this->Setting_model->get(array('id'=>SCHOOL_LOGO));
            $this->load->view('manage/login',$data);
        }
    }

    // Logout Processing
    function logout() {
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('uemail');
        $this->session->unset_userdata('ufullname');
        $this->session->unset_userdata('uroleid');
        $this->session->unset_userdata('urolename');
        $this->session->unset_userdata('user_image');

        $q = $this->input->get(NULL, TRUE);
        if ($q['location'] != NULL) {
            $location = $q['location'];
        } else {
            $location = NULL;
        }
        header("Location:" . $location);
    }

}
