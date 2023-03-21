<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_set extends CI_Controller {

	public function __construct() {
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('payment/Payment_model', 'student/Student_model', 'period/Period_model', 'pos/Pos_model', 'bulan/Bulan_model', 'bebas/Bebas_model', 'bebas/Bebas_pay_model', 'setting/Setting_model', 'kredit/Kredit_model', 'debit/Debit_model', 'logs/Logs_model'));

	}

    // payment view in list
	public function index($offset = NULL) {
        // Apply Filter
        // Get $_GET variable
		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;

		$params = array();

    // Date start
		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}

        // Date end
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}


		$paramsPage = $params;
		$data['period'] = $this->Period_model->get($params);
		$data['student'] = $this->Bulan_model->get(array('group'=>true));
		$data['bulan'] = $this->Bulan_model->get($params);
		$data['month'] = $this->Bulan_model->get(array('grup'=>true));
		$data['py'] = $this->Bulan_model->get(array('paymentt'=>true));
		$data['bebas'] = $this->Bebas_model->get(array('grup'=>true));
		$data['free'] = $this->Bebas_model->get($params);
		$data['dom'] = $this->Bebas_pay_model->get($params);


		$config['base_url'] = site_url('manage/report/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Bulan_model->get($paramsPage));

		$data['title'] = 'Laporan Keuangan';
		$data['main'] = 'report/report_list';
		$this->load->view('manage/layout', $data);
	}

	public function report_bill() {

		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;

		$params = array();
		$param = array();
		$stu = array();
		$free = array();

		if (isset($q['p']) && !empty($q['p']) && $q['p'] != '') {
			$params['period_id'] = $q['p'];
			$param['period_id'] = $q['p'];
			$stu['period_id'] = $q['p'];
			$free['period_id'] = $q['p'];
		}

		if (isset($q['c']) && !empty($q['c']) && $q['c'] != '') {
			$params['class_id'] = $q['c'];
			$param['class_id'] = $q['c'];
			$stu['class_id'] = $q['c'];
			$free['class_id'] = $q['c'];
		}

		if (isset($q['k']) && !empty($q['k']) && $q['k'] != '') {
			$params['majors_id'] = $q['k'];
			$param['majors_id'] = $q['k'];
			$stu['majors_id'] = $q['k'];
			$free['majors_id'] = $q['k'];
		}

		$param['paymentt'] = TRUE;
		$params['grup'] = TRUE;
		$stu['group'] = TRUE;


		$data['period'] = $this->Period_model->get($params);
		$data['class'] = $this->Student_model->get_class($params);
		$data['majors'] = $this->Student_model->get_majors($params);
		$data['student'] = $this->Bulan_model->get($stu);
		$data['bulan'] = $this->Bulan_model->get($free);
		$data['month'] = $this->Bulan_model->get($params);
		$data['py'] = $this->Bulan_model->get($param);
		$data['bebas'] = $this->Bebas_model->get($params);
		$data['free'] = $this->Bebas_model->get($free);

		$config['suffix'] = '?' . http_build_query($_GET, '', "&");

		$data['title'] = 'Rekapitulasi';
		$data['main'] = 'report/report_bill_list';
		$this->load->view('manage/layout', $data);
	}

	public function report()
	{
        // Apply Filter
        // Get $_GET variable
		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;

		$params = array();

        // Date start
		if (isset($q['ds']) && !empty($q['ds']) && $q['ds'] != '') {
			$params['date_start'] = $q['ds'];
		}

        // Date end
		if (isset($q['de']) && !empty($q['de']) && $q['de'] != '') {
			$params['date_end'] = $q['de'];
		}

		$params['status'] = 1;


		$data['bulan'] = $this->Bulan_model->get($params);
		$data['bebas'] = $this->Bebas_model->get($params);
		$data['free'] = $this->Bebas_pay_model->get($params);
		$data['kredit'] = $this->Kredit_model->get($params);
		$data['debit'] = $this->Debit_model->get($params);
		$data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));

		$this->load->library("PHPExcel");
		$objXLS   = new PHPExcel();
		$objSheet = $objXLS->setActiveSheetIndex(0);            
		$cell     = 6;        
		$no       = 1;

		$objSheet->setCellValue('A1', 'Laporan Keuangan');
		$objSheet->setCellValue('A2', $data['setting_school']['setting_value'] );
		$objSheet->setCellValue('A3', 'Tanggal Laporan: '.pretty_date($q['ds'],'d F Y',false).' s/d '.pretty_date($q['de'],'d F Y',false));
		$objSheet->setCellValue('A4', 'Tanggal Unduh: '.pretty_date(date('Y-m-d h:i:s'),'d F Y, H:i',false));
		$objSheet->setCellValue('C4', 'Pengunduh: '.$this->session->userdata('ufullname'));
		

		$objSheet->setCellValue('A5', 'NO');
		$objSheet->setCellValue('B5', 'PEMBAYARAN');
		$objSheet->setCellValue('C5', 'NAMA SISWA');
		$objSheet->setCellValue('D5', 'KELAS');
		$objSheet->setCellValue('E5', 'TANGGAL');
		$objSheet->setCellValue('F5', 'PENERIMAAN');
		$objSheet->setCellValue('G5', 'PENGELUARAN');     
		$objSheet->setCellValue('H5', 'KETERANGAN');     


		foreach ($data['bulan'] as $row) {

			$objSheet->setCellValue('A'.$cell, $no);
			$objSheet->setCellValueExplicit('B'.$cell, $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'].'-'.$row['month_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValueExplicit('C'.$cell, $row['student_full_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValueExplicit('D'.$cell, $row['class_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValue('E'.$cell, pretty_date($row['bulan_date_pay'], 'm/d/Y', FALSE));
			$objSheet->setCellValue('F'.$cell, $row['bulan_bill']);
			$objSheet->setCellValue('G'.$cell, ' ');
			$cell++;
			$no++;    
		}

		foreach ($data['free'] as $row) {

			$objSheet->setCellValue('A'.$cell, $no);
			$objSheet->setCellValueExplicit('B'.$cell, $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValueExplicit('C'.$cell, $row['student_full_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValueExplicit('D'.$cell, $row['class_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValue('E'.$cell, pretty_date($row['bebas_pay_input_date'], 'm/d/Y', FALSE));
			$objSheet->setCellValue('F'.$cell, $row['bebas_pay_bill']);
			$objSheet->setCellValue('G'.$cell, ' ');
			$cell++;
			$no++;    
		}

		foreach ($data['kredit'] as $row) {

			$objSheet->setCellValue('A'.$cell, $no);
			$objSheet->setCellValueExplicit('B'.$cell, $row['kredit_desc'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValue('C'.$cell, '-');
			$objSheet->setCellValue('D'.$cell, '-');
			$objSheet->setCellValue('E'.$cell, pretty_date($row['kredit_date'], 'm/d/Y', FALSE));
			$objSheet->setCellValue('F'.$cell, '');
			$objSheet->setCellValue('G'.$cell, $row['kredit_value']);
			$cell++;
			$no++;    
		}

		foreach ($data['debit'] as $row) {

			$objSheet->setCellValue('A'.$cell, $no);
			$objSheet->setCellValueExplicit('B'.$cell, $row['debit_desc'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValue('C'.$cell, '-');
			$objSheet->setCellValue('D'.$cell, '-');
			$objSheet->setCellValue('E'.$cell, pretty_date($row['debit_date'], 'm/d/Y', FALSE));
			$objSheet->setCellValue('F'.$cell, $row['debit_value']);
			$objSheet->setCellValue('G'.$cell, '');
			$cell++;
			$no++;    
		}                      

		$objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(20);

		foreach(range('D', 'Z') as $alphabet)
		{
			$objXLS->getActiveSheet()->getColumnDimension($alphabet)->setWidth(20);
		}

		$objXLS->getActiveSheet()->getColumnDimension('N')->setWidth(20);

		$font = array('font' => array( 'bold' => true, 'color' => array(
			'rgb'  => 'FFFFFF')));
		$objXLS->getActiveSheet()
		->getStyle('A5:H5')
		->applyFromArray($font);

		$objXLS->getActiveSheet()
		->getStyle('A5:H5')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('000');
		$objXLS->getActiveSheet()->getStyle('A1')->getFont()->setBold( true );
		$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="LAPORAN_KEUANGAN_'.date('dmY').'.xls"'); 
		header('Cache-Control: max-age=0'); 
		$objWriter->save('php://output'); 
		exit();      
	}


// Rekapituliasi
	public function report_bill_detail()
	{
		$q = $this->input->get(NULL, TRUE);

		$data['q'] = $q;

		$params = array();
		$param = array();
		$stu = array();
		$free = array();

		if (isset($q['p']) && !empty($q['p']) && $q['p'] != '') {
			$params['period_id'] = $q['p'];
			$param['period_id'] = $q['p'];
			$stu['period_id'] = $q['p'];
			$free['period_id'] = $q['p'];
		}

		if (isset($q['c']) && !empty($q['c']) && $q['c'] != '') {
			$params['class_id'] = $q['c'];
			$param['class_id'] = $q['c'];
			$stu['class_id'] = $q['c'];
			$free['class_id'] = $q['c'];
		}

		if (isset($q['k']) && !empty($q['k']) && $q['k'] != '') {
			$params['majors_id'] = $q['k'];
			$param['majors_id'] = $q['k'];
			$stu['majors_id'] = $q['k'];
			$free['majors_id'] = $q['k'];
		}

		$param['paymentt'] = TRUE;
		$params['grup'] = TRUE;
		$stu['group'] = TRUE;

		$data['period'] = $this->Period_model->get($params);
		$data['class'] = $this->Student_model->get_class($stu);
		$data['majors'] = $this->Student_model->get_majors($stu);
		$data['student'] = $this->Bulan_model->get($stu);
		$data['bulan'] = $this->Bulan_model->get($free);
		$data['month'] = $this->Bulan_model->get($params);
		$data['py'] = $this->Bulan_model->get($param);
		$data['bebas'] = $this->Bebas_model->get($params);
		$data['free'] = $this->Bebas_model->get($free);

		$data['setting_school'] = $this->Setting_model->get(array('id' => SCHOOL_NAME));

		$this->load->library("PHPExcel");
		$objXLS   = new PHPExcel();
		$objSheet = $objXLS->setActiveSheetIndex(0);            
		$cell     = 7;        
		$no       = 1;
		$font = array('font' => array( 'bold' => true, 'color' => array(
			'rgb'  => 'FFFFFF')));

		$objXLS->setActiveSheetIndex(0);        
		$styleArray = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array(
							'rgb'  => 'FFFFFF' 
						),
					),
				),
			),
		);
		$borderStyle = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array(
						'rgb'  => '111111' 
					),
				),
			),
		);
		

		$objSheet->setCellValue('A1', 'REKAPITULASI PEMBAYARAN SISWA');
		$objSheet->setCellValue('A2', $data['setting_school']['setting_value'] );

		foreach ($data['period'] as $period) {
			$year = $period['period_start'].'/'.$period['period_end'];
			$periode = ($q['p']==$period['period_id']) ? $year : '';
			$objSheet->setCellValue('A3', 'Periode Laporan: '. $periode);
		}
		$objSheet->setCellValue('A4', 'Tanggal Unduh: '.pretty_date(date('Y-m-d h:i:s'),'d F Y, H:i',false));
		$objSheet->setCellValue('C4', 'Pengunduh: '.$this->session->userdata('ufullname'));
		

		$objSheet->mergeCells('A5:A6');
		$objSheet->setCellValue('A5', 'NO');
		$objSheet->mergeCells('B5:B6');
		$objSheet->setCellValue('B5', 'KELAS');
		$objSheet->mergeCells('C5:C6');
		$objSheet->setCellValue('C5', 'NAMA SISWA');
		$objXLS->getActiveSheet()->getStyle('A5:C5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000');
		$objXLS->getActiveSheet()->getStyle('A5:C5')->applyFromArray($font);
		$objSheet->getStyle('A5:C5')->applyFromArray($styleArray);
		$objSheet->getStyle('A6:C6')->applyFromArray($styleArray);

		// Judul Pembayaran Bulanan
		$objSheet->mergeCells('D5:'.getCell(count($data['month'])+3).'5');
		foreach ($data['py'] as $row) {
			$objSheet->setCellValue('D5', $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end']); 
			$objXLS->getActiveSheet()->getStyle('D5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000');
			$objXLS->getActiveSheet()->getStyle('D5')->applyFromArray($font);
			$objSheet->getStyle('D5:'.getCell(count($data['month'])+3).'5')->applyFromArray($styleArray);
		}

		$i =0;
		foreach ($data['bebas'] as $key) {
			$objSheet->mergeCells(getCell(count($data['month'])+4+$i).'5:'.getCell(count($data['month'])+4+$i).'6');
			$objSheet->getStyle(getCell(count($data['month'])+4+$i).'5:'.getCell(count($data['month'])+4+$i).'6')->applyFromArray($styleArray);
			$i++;
		}

		$j =0;
		foreach ($data['bebas'] as $row) {
			$objSheet->setCellValue(getCell(count($data['month'])+4+$j).'5', $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end']);
			$objXLS->getActiveSheet()->getStyle(getCell(count($data['month'])+4+$j).'5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000');
			$objXLS->getActiveSheet()->getStyle(getCell(count($data['month'])+4+$j).'5')->applyFromArray($font);
			$objSheet->getStyle(getCell(count($data['month'])+4+$j).'5')->applyFromArray($styleArray);
			$j++;
		}

		$alpha = 4;
		foreach ($data['month'] as $key) {
			$objSheet->setCellValue(getCell($alpha).'6', $key['month_name']); 
			$objXLS->getActiveSheet()->getStyle(getCell($alpha).'6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('000');
			$objXLS->getActiveSheet()->getStyle(getCell($alpha).'6')->applyFromArray($font);
			$objSheet->getStyle(getCell($alpha).'6')->applyFromArray($styleArray);
			$alpha++;
		}
		


		foreach ($data['student'] as $row) {

			$objSheet->setCellValue('A'.$cell, $no);
			$objSheet->setCellValueExplicit('B'.$cell, (majors()=='senior') ? $row['class_name'].'-'.$row['majors_short_name'] : $row['class_name'],PHPExcel_Cell_DataType::TYPE_STRING);
			$objSheet->setCellValueExplicit('C'.$cell, $row['student_full_name'],PHPExcel_Cell_DataType::TYPE_STRING);


			$alphdata = 4;
			foreach ($data['bulan'] as $key) {
				if ($key['student_student_id']==$row['student_student_id']) {
					$objSheet->setCellValue(getCell($alphdata).$cell, ($key['bulan_status']==1) ? 'Lunas' : $key['bulan_bill']);
					$alphdata++;
				}
			}

			foreach ($data['free'] as $key) {
				if ($key['student_student_id']==$row['student_student_id']) {
					$objSheet->setCellValue(getCell($alphdata).$cell, ($key['bebas_bill']==$key['bebas_total_pay']) ? 'Lunas' : $key['bebas_bill']-$key['bebas_total_pay']);
					$alphdata++;
				}
			}

			$cell++;
			$no++;    
		}
		

		$objXLS->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objXLS->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objXLS->getActiveSheet()->getColumnDimension('C')->setWidth(40);

		foreach(range('D', 'Z') as $alphabet)
		{
			$objXLS->getActiveSheet()->getColumnDimension($alphabet)->setWidth(20);
		}

		foreach ($data['class'] as $row) {
			if ($q['c']==$row['class_id']){
				$kelas = $row['class_name'];
			} else {
				$kelas = 'PEMBAYARAN_SISWA';
			}
		}


		$objXLS->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$objXLS->getActiveSheet()->getStyle('A1')->getFont()->setBold( true );
		$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
		header('Content-Type: application/vnd.ms-excel'); 
		header('Content-Disposition: attachment;filename="REKAPITULASI_'.$kelas.'_'.date('dmY').'.xls"'); 
		header('Cache-Control: max-age=0'); 
		$objWriter->save('php://output'); 
		exit();      
	}

}

/* End of file Report_set.php */
/* Location: ./application/modules/report/controllers/Report_set.php */