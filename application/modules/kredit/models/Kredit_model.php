<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kredit_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get kredit from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('kredit_id', $params['id']);
		}

		if (isset($params['date'])) {
			$this->db->where('kredit_date', $params['date']);
		}

		if (isset($params['kredit_desc'])) {
			$this->db->like('kredit_desc', $params['kredit_desc']);
		}

		if(isset($params['kredit_input_date']))
		{
			$this->db->where('kredit_input_date', $params['kredit_input_date']);
		}

		if(isset($params['kredit_last_update']))
		{
			$this->db->where('kredit_last_update', $params['kredit_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('kredit_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('kredit_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('kredit_id', 'desc');
		}

		$this->db->select('kredit_id, kredit_date, kredit_value, kredit_desc, kredit_input_date, kredit_last_update');
		$this->db->select('user_user_id, user_full_name');

		$this->db->join('users', 'users.user_id = kredit.user_user_id', 'left');

		$res = $this->db->get('kredit');

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

		if(isset($data['kredit_id'])) {
			$this->db->set('kredit_id', $data['kredit_id']);
		}

		if(isset($data['kredit_date'])) {
			$this->db->set('kredit_date', $data['kredit_date']);
		}

		if(isset($data['kredit_value'])) {
			$this->db->set('kredit_value', $data['kredit_value']);
		}

		if(isset($data['kredit_desc'])) {
			$this->db->set('kredit_desc', $data['kredit_desc']);
		}

		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['kredit_input_date'])) {
			$this->db->set('kredit_input_date', $data['kredit_input_date']);
		}

		if(isset($data['kredit_last_update'])) {
			$this->db->set('kredit_last_update', $data['kredit_last_update']);
		}

		if (isset($data['kredit_id'])) {
			$this->db->where('kredit_id', $data['kredit_id']);
			$this->db->update('kredit');
			$id = $data['kredit_id'];
		} else {
			$this->db->insert('kredit');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete kredit to database
	function delete($id) {
		$this->db->where('kredit_id', $id);
		$this->db->delete('kredit');
	}
	

}

/* End of file kredit_model.php */
/* Location: ./application/modules/jurnal/models/kredit_model.php */