<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {

        if (isset($params['id'])) {
            $this->db->where('student.student_id', $params['id']);
        }
        if (isset($params['student_id'])) {
            $this->db->where('student.student_id', $params['student_id']);
        }

        if (isset($params['multiple_id'])) {
            $this->db->where_in('student.student_id', $params['multiple_id']);
        }

        if(isset($params['student_search']))
        {
            $this->db->where('student_nis', $params['student_search']);
            $this->db->or_like('student_full_name', $params['student_search']);
        }

        if (isset($params['student_nis'])) {
            $this->db->where('student.student_nis', $params['student_nis']);
        }

        if (isset($params['nis'])) {
            $this->db->like('student_nis', $params['nis']);
        }

        if (isset($params['password'])) {
            $this->db->like('student_password', $params['password']);
        }

        if (isset($params['student_full_name'])) {
            $this->db->where('student.student_full_name', $params['student_full_name']);
        }

        if (isset($params['status'])) {
            $this->db->where('student.student_status', $params['status']);
        }
        
        if (isset($params['date'])) {
            $this->db->where('student_input_date', $params['date']);
        }

        if (isset($params['class_id'])) {
            $this->db->where('class_class_id', $params['class_id']);
        }

        if (isset($params['majors_id'])) {
            $this->db->where('majors_majors_id', $params['majors_id']);
        }

        if (isset($params['class_name'])) {
            $this->db->like('class_name', $params['class_name']);
        }

        if(isset($params['group']))
        {

            $this->db->group_by('student.class_class_id'); 

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
            $this->db->order_by('student_last_update', 'desc');
        }

        $this->db->select('student.student_id, student_nis, student_nisn, student_password, student_gender, student_phone, student_hobby, student_address, student_parent_phone, student_full_name, student_born_place, student_born_date, student_img, student_status, student_name_of_mother, student_name_of_father, student_input_date, student_last_update');
        $this->db->select('class_class_id, class.class_name');
        $this->db->select('majors_majors_id, majors.majors_name, majors_short_name');

        $this->db->join('class', 'class.class_id = student.class_class_id', 'left');
        $this->db->join('majors', 'majors.majors_id = student.majors_majors_id', 'left');

        $res = $this->db->get('student');

        

        if (isset($params['id'])) {
            return $res->row_array();
        } else if (isset($params['student_nis'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }

    }

    function get_class($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('class_id', $params['id']);
        }

        if(isset($params['class_name']))
        {
            $this->db->where('class_name', $params['class_name']);
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
            $this->db->order_by('class_id', 'asc');
        }

        $this->db->select('class_id, class_name');
        $res = $this->db->get('class');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    function get_majors($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('majors_id', $params['id']);
        }

        if(isset($params['majors_name']))
        {
            $this->db->where('majors_name', $params['majors_name']);
        }

        if(isset($params['majors_short_name']))
        {
            $this->db->where('majors_short_name', $params['majors_short_name']);
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
            $this->db->order_by('majors_id', 'asc');
        }

        $this->db->select('majors_id, majors_name, majors_short_name');
        $res = $this->db->get('majors');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    

    function add($data = array()) {

        if (isset($data['student_id'])) {
            $this->db->set('student_id', $data['student_id']);
        }

        if (isset($data['student_nis'])) {
            $this->db->set('student_nis', $data['student_nis']);
        }

        if (isset($data['student_nisn'])) {
            $this->db->set('student_nisn', $data['student_nisn']);
        }

        if (isset($data['student_password'])) {
            $this->db->set('student_password', $data['student_password']);
        }

        if (isset($data['student_gender'])) {
            $this->db->set('student_gender', $data['student_gender']);
        }

        if (isset($data['student_phone'])) {
            $this->db->set('student_phone', $data['student_phone']);
        }

        if (isset($data['student_parent_phone'])) {
            $this->db->set('student_parent_phone', $data['student_parent_phone']);
        }

        if (isset($data['student_hobby'])) {
            $this->db->set('student_hobby', $data['student_hobby']);
        }

        if (isset($data['student_address'])) {
            $this->db->set('student_address', $data['student_address']);
        }

        if (isset($data['student_name_of_father'])) {
            $this->db->set('student_name_of_father', $data['student_name_of_father']);
        }

        if (isset($data['student_full_name'])) {
            $this->db->set('student_full_name', $data['student_full_name']);
        }

        if (isset($data['student_img'])) {
            $this->db->set('student_img', $data['student_img']);
        }

        if (isset($data['student_born_place'])) {
            $this->db->set('student_born_place', $data['student_born_place']);
        }

        if (isset($data['student_born_date'])) {
            $this->db->set('student_born_date', $data['student_born_date']);
        }

        if (isset($data['student_name_of_mother'])) {
            $this->db->set('student_name_of_mother', $data['student_name_of_mother']);
        }

        if (isset($data['class_class_id'])) {
            $this->db->set('class_class_id', $data['class_class_id']);
        }

        if (isset($data['majors_majors_id'])) {
            $this->db->set('majors_majors_id', $data['majors_majors_id']);
        }

        if (isset($data['student_status'])) {
            $this->db->set('student_status', $data['student_status']);
        }

        if (isset($data['student_input_date'])) {
            $this->db->set('student_input_date', $data['student_input_date']);
        }

        if (isset($data['student_last_update'])) {
            $this->db->set('student_last_update', $data['student_last_update']);
        }

        if (isset($data['student_id'])) {
            $this->db->where('student_id', $data['student_id']);
            $this->db->update('student');
            $id = $data['student_id'];
        } else {
            $this->db->insert('student');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_class($data = array()) {

        if (isset($data['class_id'])) {
            $this->db->set('class_id', $data['class_id']);
        }

        if (isset($data['class_name'])) {
            $this->db->set('class_name', $data['class_name']);
        }

        if (isset($data['class_id'])) {
            $this->db->where('class_id', $data['class_id']);
            $this->db->update('class');
            $id = $data['class_id'];
        } else {
            $this->db->insert('class');
            $id = $this->db->insert_id(); 
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function add_majors($data = array()) {

        if (isset($data['majors_id'])) {
            $this->db->set('majors_id', $data['majors_id']);
        }

        if (isset($data['majors_name'])) {
            $this->db->set('majors_name', $data['majors_name']);
        }

        if (isset($data['majors_short_name'])) {
            $this->db->set('majors_short_name', $data['majors_short_name']);
        }

        if (isset($data['majors_id'])) {
            $this->db->where('majors_id', $data['majors_id']);
            $this->db->update('majors');
            $id = $data['majors_id'];
        } else {
            $this->db->insert('majors');
            $id = $this->db->insert_id(); 
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id) {
        $this->db->where('student_id', $id);
        $this->db->delete('student');
    }

    function delete_class($id) {
        $this->db->where('class_id', $id);
        $this->db->delete('class');
    }

    function delete_majors($id) {
        $this->db->where('majors_id', $id);
        $this->db->delete('majors');
    }

    public function is_exist($field, $value)
    {
        $this->db->where($field, $value);        

        return $this->db->count_all_results('student') > 0 ? TRUE : FALSE;
    }

    function change_password($id, $params) {
        $this->db->where('student_id', $id);
        $this->db->update('student', $params);
    }

}
