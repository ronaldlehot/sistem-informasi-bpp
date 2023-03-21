<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday_set extends CI_Controller {

	public function index()
	{
		if ($_POST) {
			$rows= explode("\n", $this->input->post('rows'));
			$success = 0;
			$failled = 0;
			$exist = 0;
			$date = '';
			foreach($rows as $row) {
				$exp = explode("\t", $row);
				if (count($exp) != 3) continue;
				$date = trim($exp[1]);
				$arr = [
					'year' => trim($exp[0]),
					'date' => trim($exp[1]),
					'info' => trim($exp[2]),
				];

				$check = $this->db
				->where('date', trim($exp[1]))
				->count_all_results('holiday');
				if ($check == 0) {
					if ($this->db->insert('holiday', $arr)) {
						$success++;
					} else {
						$failled++;
					}
				} else {
					$exist++;
				}
			}
			$msg = 'Sukses : ' . $success. ' baris, Gagal : '. $failled .', Duplikat : ' . $exist;
			$this->session->set_flashdata('success', $msg);
			redirect('manage/holiday/import');
		} else {
			$data['title'] = 'Import Data Hari Libur';
			$data['main'] = 'holiday/holiday_upload';
			$this->load->view('manage/layout', $data);
		}
	}

	public function download() {
		$data = file_get_contents("./media/template_excel/template_libur_nasional.xls");
		$name = 'template_libur_nasional.xls';
		$this->load->helper('download');
		force_download($name, $data);
	}

}

/* End of file Holiday_set.php */
/* Location: ./application/modules/holiday/controllers/Holiday_set.php */