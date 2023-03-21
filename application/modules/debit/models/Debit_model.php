<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debit_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get debit from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('debit_id', $params['id']);
		}

		if (isset($params['date'])) {
			$this->db->where('debit_date', $params['date']);
		}

		if (isset($params['debit_desc'])) {
			$this->db->like('debit_desc', $params['debit_desc']);
		}

		if(isset($params['debit_input_date']))
		{
			$this->db->where('debit_input_date', $params['debit_input_date']);
		}

		if(isset($params['debit_last_update']))
		{
			$this->db->where('debit_last_update', $params['debit_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('debit_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('debit_date <=', $params['date_end'] . ' 23:59:59');
		}

		if(isset($params['limit']))
		{
			if(!isset($params['offset']))
			{
				$params['offset'] = NULL;
			}

			$this->db->limit($params['limit'], $params['offset']);
		}
		if(isset($params['order_by']))
		{
			$this->db->order_by($params['order_by'], 'desc');
		}
		else
		{
			$this->db->order_by('debit_id', 'desc');
		}

		$this->db->select('debit_id, debit_date, debit_value, debit_desc, debit_input_date, debit_last_update');
		$this->db->select('user_user_id, user_full_name');

		$this->db->join('users', 'users.user_id = debit.user_user_id', 'left');

		$res = $this->db->get('debit');

		if(isset($params['id']))
		{
			return $res->row_array();
		}
		else
		{
			return $res->result_array();
		}
	}

    // Add and update to database
	function add($data = array()) {

		if(isset($data['debit_id'])) {
			$this->db->set('debit_id', $data['debit_id']);
		}

		if(isset($data['debit_date'])) {
			$this->db->set('debit_date', $data['debit_date']);
		}

		if(isset($data['debit_value'])) {
			$this->db->set('debit_value', $data['debit_value']);
		}

		if(isset($data['debit_desc'])) {
			$this->db->set('debit_desc', $data['debit_desc']);
		}

		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['debit_input_date'])) {
			$this->db->set('debit_input_date', $data['debit_input_date']);
		}

		if(isset($data['debit_last_update'])) {
			$this->db->set('debit_last_update', $data['debit_last_update']);
		}

		if (isset($data['debit_id'])) {
			$this->db->where('debit_id', $data['debit_id']);
			$this->db->update('debit');
			$id = $data['debit_id'];
		} else {
			$this->db->insert('debit');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete debit to database
	function delete($id) {
		$this->db->where('debit_id', $id);
		$this->db->delete('debit');
	}
	

}

/* End of file debit_model.php */
/* Location: ./application/modules/jurnal/models/debit_model.php */