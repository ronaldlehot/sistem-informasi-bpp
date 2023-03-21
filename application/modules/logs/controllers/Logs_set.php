<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Logs controllers Class
 *
 * @package     Arca CMS
 * @subpackage  Controllers
 * @category    Controllers 
 * @author      Achyar Anshorie
 */
class Logs_set extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('logs/Logs_model');
    }

    public function index($offset = NULL) {
        $this->load->library('pagination');
        
        $params = array();
        $paramsPage = $params;
        $params['limit'] = 5;
        $params['offset'] = $offset;
        $data['logs'] = $this->Logs_model->get($params);
        
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('manage/logs/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Logs_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Log Aktifitas';
        $data['main'] = 'logs/log_list';
        $this->load->view('manage/layout', $data);
    }

}
