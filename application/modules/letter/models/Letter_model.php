<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Letter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {
        if (isset($params['id'])) {
            $this->db->where('letter.letter_id', $params['id']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('letter_id', 'desc');
        }
        $this->db->select('letter.letter_id, letter_number, letter_month, letter_year');       
        $res = $this->db->get('letter');

        if (isset($params['id']) OR (isset($params['limit']) AND $params['limit']==1))
        {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }
    
    // Insert some data to table
    function add($data = array()) {

        if (isset($data['letter_id'])) {
            $this->db->set('letter_id', $data['letter_id']);
        }

        if (isset($data['letter_number'])) {
            $this->db->set('letter_number', $data['letter_number']);
        }

        if (isset($data['letter_month'])) {
            $this->db->set('letter_month', $data['letter_month']);
        }

        if (isset($data['letter_year'])) {
            $this->db->set('letter_year', $data['letter_year']);
        }

        if (isset($data['letter_id'])) {
            $this->db->where('letter_id', $data['letter_id']);
            $this->db->update('letter');
            $id = $data['letter_id'];
        } else {
            $this->db->insert('letter');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

}
