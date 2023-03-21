<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('users.user_id', $params['id']);
        }
        if (isset($params['user_id'])) {
            $this->db->where('users.user_id', $params['user_id']);
        }

        if (isset($params['email'])) {
            $this->db->like('user_email', $params['email']);
        }
        
        if (isset($params['password'])) {
            $this->db->like('user_password', $params['password']);
        }

        if (isset($params['search'])) {
            $this->db->where('user_email', $params['search']);
            $this->db->or_like('user_full_name', $params['search']);
        }

        if (isset($params['date'])) {
            $this->db->where('user_input_date', $params['date']);
        }

        if (isset($params['user_role_role_id'])) {
            $this->db->where('user_role_role_id', $params['user_role_role_id']);
        }

        $this->db->where('user_is_deleted', FALSE);

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('user_last_update', 'desc');
        }

        $this->db->select('users.user_id, user_password, user_full_name, user_description,
            user_email, user_is_deleted, user_image, user_input_date, user_last_update');
        $this->db->select('user_role_role_id, user_roles.role_name');

        $this->db->join('user_roles', 'user_roles.role_id = users.user_role_role_id', 'left');
        $res = $this->db->get('users');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    // Get Role From Databases
    function get_role($params = array()) {
        $this->db->select('user_roles.role_id, role_name');

        if (isset($params['id'])) {
            $this->db->where('user_roles.role_id', $params['id']);
        }
        if (isset($params['role_id'])) {
            $this->db->where('user_roles.role_id', $params['role_id']);
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
            $this->db->order_by('user_roles.role_id', 'desc');
        }

        $res = $this->db->get('user_roles');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    function add($data = array()) {

        if (isset($data['user_id'])) {
            $this->db->set('user_id', $data['user_id']);
        }

        if (isset($data['user_password'])) {
            $this->db->set('user_password', $data['user_password']);
        }

        if (isset($data['user_full_name'])) {
            $this->db->set('user_full_name', $data['user_full_name']);
        }

        if (isset($data['user_email'])) {
            $this->db->set('user_email', $data['user_email']);
        }

        if (isset($data['user_image'])) {
            $this->db->set('user_image', $data['user_image']);
        }

        if (isset($data['user_description'])) {
            $this->db->set('user_description', $data['user_description']);
        }

        if (isset($data['user_input_date'])) {
            $this->db->set('user_input_date', $data['user_input_date']);
        }

        if (isset($data['user_last_update'])) {
            $this->db->set('user_last_update', $data['user_last_update']);
        }

        if (isset($data['user_is_deleted'])) {
            $this->db->set('user_is_deleted', $data['user_is_deleted']);
        }

        if (isset($data['user_role_role_id'])) {
            $this->db->set('user_role_role_id', $data['user_role_role_id']);
        }

        if (isset($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('users');
            $id = $data['user_id'];
        } else {
            $this->db->insert('users');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_role($data = array()) {

        if (isset($data['role_id'])) {
            $this->db->set('role_id', $data['role_id']);
        }

        if (isset($data['role_name'])) {
            $this->db->set('role_name', $data['role_name']);
        }

        if (isset($data['role_id'])) {
            $this->db->where('role_id', $data['role_id']);
            $this->db->update('user_roles');
            $id = $data['role_id'];
        } else {
            $this->db->insert('user_roles');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('users');
    }

    function delete_role($id) {
        $this->db->where('role_id', $id);
        $this->db->delete('user_roles');
    }

    function change_password($id, $params) {
        $this->db->where('user_id', $id);
        $this->db->update('users', $params);
    }

}
