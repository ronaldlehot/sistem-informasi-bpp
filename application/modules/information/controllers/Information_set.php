<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('information/Information_model', 'logs/Logs_model'));
		$this->load->library('upload');
	}

    // information view in list
	public function index($offset = NULL) {
		$this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
		$f = $this->input->get(NULL, TRUE);

		$data['f'] = $f;

		$params = array();
        // Nip
		if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
			$params['user_nik'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 5;
		$params['offset'] = $offset;
		$data['information'] = $this->Information_model->get($params);

		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/information/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Information_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'Informasi';
		$data['main'] = 'information/information_list';
		$this->load->view('manage/layout', $data);
	}


    // Add information and Update
	public function add($id = NULL) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('information_title', 'Judul', 'trim|required|xss_clean');
		$this->form_validation->set_rules('information_desc', 'Keterangan', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST AND $this->form_validation->run() == TRUE) {

			if ($this->input->post('information_id')) {
				$params['information_id'] = $this->input->post('information_id');
			} else {
				$params['information_input_date'] = date('Y-m-d H:i:s');
			}

			$params['information_title'] = $this->input->post('information_title');
			$params['information_desc'] = $this->input->post('information_desc');
			$params['information_publish'] = $this->input->post('information_publish');
			$params['information_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Information_model->add($params);

			if (!empty($_FILES['information_img']['name'])) {
				$paramsupdate['information_img'] = $this->do_upload($name = 'information_img', $fileName= $params['information_title']);
			} 

			$paramsupdate['information_id'] = $status;
			$this->Information_model->add($paramsupdate);


            // activity log
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('user_id'),
					'log_module' => 'Pengeluaran',
					'log_action' => $data['operation'],
					'log_info' => 'ID:null;Title:' . $params['information_desc']
				)
			);

			$this->session->set_flashdata('success', $data['operation'] . ' Pengeluaran berhasil');
			redirect('manage/information');
		} else {
			if ($this->input->post('information_id')) {
				redirect('manage/information/edit/' . $this->input->post('information_id'));
			}

            // Edit mode
			if (!is_null($id)) {
				$data['information'] = $this->Information_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Informasi';
			$data['main'] = 'information/information_add';
			$this->load->view('manage/layout', $data);
		}
	}


    // Delete to database
	public function delete($id = NULL) {
		if ($this->session->userdata('uroleid')!= SUPERUSER){
			redirect('manage');
		}
		if ($_POST) {
			$this->Information_model->delete($id);
            // activity log
			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'Informasi',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus Informasi berhasil');
			redirect('manage/information');
		} elseif (!$_POST) {
			$this->session->set_flashdata('delete', 'Delete');
			redirect('manage/information/edit/' . $id);
		}
	}

	// Setting Upload File Requied
	function do_upload($name=NULL, $fileName=NULL) {
		$this->load->library('upload');

		$config['upload_path'] = FCPATH . 'uploads/information/';

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

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */