<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    // Get pos from database
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('pos_id', $params['id']);
        }

        if(isset($params['pos_name']))
        {
            $this->db->like('pos_name', $params['pos_name']);
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
            $this->db->order_by('pos_id', 'desc');
        }

        $this->db->select('pos_id, pos_name, pos_description');
        $res = $this->db->get('pos');

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
        
         if(isset($data['pos_id'])) {
            $this->db->set('pos_id', $data['pos_id']);
        }
        
         if(isset($data['pos_name'])) {
            $this->db->set('pos_name', $data['pos_name']);
        }

        if(isset($data['pos_description'])) {
            $this->db->set('pos_description', $data['pos_description']);
        }
        
        
        if (isset($data['pos_id'])) {
            $this->db->where('pos_id', $data['pos_id']);
            $this->db->update('pos');
            $id = $data['pos_id'];
        } else {
            $this->db->insert('pos');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    // Delete pos to database
    function delete($id) {
        $this->db->where('pos_id', $id);
        $this->db->delete('pos');
    }
    
}
