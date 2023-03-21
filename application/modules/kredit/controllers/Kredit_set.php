<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kredit_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('kredit/Kredit_model', 'logs/Logs_model'));
		$this->load->library('upload');
	}

    // kredit view in list
	public function index($offset = NULL) {
		$this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
		$f = $this->input->get(NULL, TRUE);

		$data['f'] = $f;

		$params = array();
        // Nip
		if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
			$params['kredit_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 5;
		$params['offset'] = $offset;
		$data['kredit'] = $this->Kredit_model->get($params);

		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/kredit/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Kredit_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'Jurnal Umum Pengeluaran';
		$data['main'] = 'kredit/kredit_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob(){
		if ($_POST == TRUE) {
			$krValue = str_replace('.', '', $_POST['kredit_value']);
			$krDesc = $_POST['kredit_desc'];
			$cpt = count($_POST['kredit_value']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['kredit_date'] = $this->input->post('kredit_date');
				$params['kredit_value'] = $krValue[$i];
				$params['kredit_desc'] = $krDesc[$i];
				$params['kredit_input_date'] = date('Y-m-d H:i:s');
				$params['kredit_last_update'] = date('Y-m-d H:i:s');
				$params['user_user_id'] = $this->session->userdata('uid');

				$this->Kredit_model->add($params);
			}
		}
		$this->session->set_flashdata('success',' Tambah Pengeluaran Berhasil');
		redirect('manage/kredit');
	}

    // Add kredit and Update
	public function add($id = NULL) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kredit_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kredit_value', 'Nilai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('kredit_desc', 'Keterangan', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST AND $this->form_validation->run() == TRUE) {

			if ($this->input->post('kredit_id')) {
				$params['kredit_id'] = $this->input->post('kredit_id');
			} else {
				$params['kredit_input_date'] = date('Y-m-d H:i:s');
			}

			$params['kredit_date'] = $this->input->post('kredit_date');
			$params['kredit_value'] = $this->input->post('kredit_value');
			$params['kredit_desc'] = $this->input->post('kredit_desc');
			$params['kredit_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Kredit_model->add($params);
			$paramsupdate['kredit_id'] = $status;
			$this->Kredit_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' Pengeluaran berhasil');
			redirect('manage/kredit');
		} else {
			if ($this->input->post('kredit_id')) {
				redirect('manage/kredit/edit/' . $this->input->post('kredit_id'));
			}

            // Edit mode
			if (!is_null($id)) {
				$data['kredit'] = $this->Kredit_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Jurnal Pengeluaran';
			$data['main'] = 'kredit/kredit_add';
			$this->load->view('manage/layout', $data);
		}
	}


    // Delete to database
	public function delete($id = NULL) {
		if ($_POST) {
			$this->Kredit_model->delete($id);
            // activity log
			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'Jurnal Pengeluaran',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus Jurnal Pengeluaran berhasil');
			redirect('manage/kredit');
		} elseif (!$_POST) {
			$this->session->set_flashdata('delete', 'Delete');
			redirect('manage/kredit/edit/' . $id);
		}
	}

}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */