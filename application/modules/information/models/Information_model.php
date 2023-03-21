<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


    // Get information from database
	function get($params = array())
	{
		if(isset($params['id']))
		{
			$this->db->where('information_id', $params['id']);
		}

		if (isset($params['information_publish'])) {
			$this->db->where('information_publish', $params['information_publish']);
		}

		if(isset($params['information_input_date']))
		{
			$this->db->where('information_input_date', $params['information_input_date']);
		}

		if(isset($params['information_last_update']))
		{
			$this->db->where('information_last_update', $params['information_last_update']);
		}
		
		if(isset($params['date_start']) AND isset($params['date_end']))
		{
			$this->db->where('information_date >=', $params['date_start'] . ' 00:00:00');
			$this->db->where('information_date <=', $params['date_end'] . ' 23:59:59');
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
			$this->db->order_by('information_id', 'desc');
		}

		$this->db->select('information_id, information_title, information_desc, information_img, information_publish, information_input_date, information_last_update');
		$this->db->select('user_user_id, user_full_name');

		$this->db->join('users', 'users.user_id = information.user_user_id', 'left');

		$res = $this->db->get('information');

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

		if(isset($data['information_id'])) {
			$this->db->set('information_id', $data['information_id']);
		}

		if(isset($data['information_title'])) {
			$this->db->set('information_title', $data['information_title']);
		}

		if(isset($data['information_desc'])) {
			$this->db->set('information_desc', $data['information_desc']);
		}

		if(isset($data['information_img'])) {
			$this->db->set('information_img', $data['information_img']);
		}

		if(isset($data['information_publish'])) {
			$this->db->set('information_publish', $data['information_publish']);
		}

		if(isset($data['user_user_id'])) {
			$this->db->set('user_user_id', $data['user_user_id']);
		}

		if(isset($data['information_input_date'])) {
			$this->db->set('information_input_date', $data['information_input_date']);
		}

		if(isset($data['information_last_update'])) {
			$this->db->set('information_last_update', $data['information_last_update']);
		}

		if (isset($data['information_id'])) {
			$this->db->where('information_id', $data['information_id']);
			$this->db->update('information');
			$id = $data['information_id'];
		} else {
			$this->db->insert('information');
			$id = $this->db->insert_id();
		}

		$status = $this->db->affected_rows();
		return ($status == 0) ? FALSE : $id;
	}

    // Delete information to database
	function delete($id) {
		$this->db->where('information_id', $id);
		$this->db->delete('information');
	}
	

}

/* End of file information_model.php */
/* Location: ./application/modules/jurnal/models/information_model.php */