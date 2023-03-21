<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Bulan_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases 
    function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('bulan.bulan_id', $params['id']);
        }

        if(isset($params['student_id']))
        {
            $this->db->where('bulan.student_student_id', $params['student_id']);
        }

        if (isset($params['multiple_id'])) {
            $this->db->where_in('bulan.bulan_id', $params['multiple_id']);
        }

        if (isset($params['date'])) {
            $this->db->where('bulan_date_pay', $params['date']);
        }

        if(isset($params['student_nis']))
        {
            $this->db->where('student_nis', $params['student_nis']);
        }

        if(isset($params['bulan_bill']))
        {
            $this->db->where('bulan_bill', $params['bulan_bill']);
        }

        if(isset($params['payment_id']))
        {
            $this->db->where('bulan.payment_payment_id', $params['payment_id']);
        }

        if(isset($params['month_id']))
        {
            $this->db->where('bulan.month_month_id', $params['month_id']);
        }

        if(isset($params['class_id']))
        {
            $this->db->where('student.class_class_id', $params['class_id']);
        }

        if(isset($params['majors_id']))
        {
            $this->db->where('student.majors_majors_id', $params['majors_id']);
        }

        if(isset($params['period_id']))
        {
            $this->db->where('payment.period_period_id', $params['period_id']);
        }

        if(isset($params['status']))
        {
            $this->db->where('bulan.bulan_status', $params['status']);
        }

        if(isset($params['period_status']))
        {
            $this->db->where('period_status', $params['period_status']);
        }

        if(isset($params['bulan_input_date']))
        {
            $this->db->where('bulan_input_date', $params['bulan_input_date']);
        }

        if(isset($params['bulan_last_update']))
        {
            $this->db->where('bulan_last_update', $params['bulan_last_update']);
        }
        
        if(isset($params['date_start']) AND isset($params['date_end']))
        {
            $this->db->where('bulan_date_pay >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('bulan_date_pay <=', $params['date_end'] . ' 23:59:59');
        }

        if(isset($params['date']))
        {
            $this->db->where('bulan_date_pay', $params['date']);
        }

        if(isset($params['group']))
        {

        $this->db->group_by('bulan.student_student_id'); 

        }

        if(isset($params['grup']))
        {

        $this->db->group_by('bulan.month_month_id'); 

        }

        if(isset($params['paymentt']))
        {

        $this->db->group_by('bulan.payment_payment_id'); 

        }

        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        $this->db->order_by('month_month_id', 'asc');

        $this->db->select('bulan.bulan_id, bulan_bill, bulan_date_pay, bulan_number_pay, bulan_status, bulan_input_date, bulan_last_update');

        $this->db->select('student_student_id, student_img, student_nis, student_full_name, student_name_of_mother, student_parent_phone, student.class_class_id, student.majors_majors_id, majors_name, majors_short_name, class_name');
        $this->db->select('payment_payment_id, period_period_id, period_status, period_start, period_end, pos_name, payment_type');
        $this->db->select('user_user_id, user_full_name');

        $this->db->select('month_month_id, month_name');
        $this->db->select('bulan.student_student_id, bulan.student_student_id');
        $this->db->join('month', 'month.month_id = bulan.month_month_id', 'left');

        $this->db->join('student', 'student.student_id = bulan.student_student_id', 'left');
        $this->db->join('payment', 'payment.payment_id = bulan.payment_payment_id', 'left');
        $this->db->join('pos', 'pos.pos_id = payment.pos_pos_id', 'left');
        $this->db->join('period', 'period.period_id = payment.period_period_id', 'left');

        $this->db->join('class', 'class.class_id = student.class_class_id', 'left');
        $this->db->join('majors', 'majors.majors_id = student.majors_majors_id', 'left');
        $this->db->join('users', 'users.user_id = bulan.user_user_id', 'left');
        $res = $this->db->get('bulan');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    // Get From Databases
    function get_total($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('bulan.bulan_id', $params['id']);
        }

        if(isset($params['student_id']))
        {
            $this->db->where('bulan.student_student_id', $params['student_id']);
        }

        if (isset($params['date'])) {
            $this->db->where('bulan_date_pay', $params['date']);
        }

        if(isset($params['student_nis']))
        {
            $this->db->where('student.student_nis', $params['student_nis']);
        }

        if(isset($params['bulan_bill']))
        {
            $this->db->where('bulan_bill', $params['bulan_bill']);
        }

        if(isset($params['payment_id']))
        {
            $this->db->where('bulan.payment_payment_id', $params['payment_id']);
        }

        if(isset($params['month_id']))
        {
            $this->db->where('bulan.month_month_id', $params['month_id']);
        }

        if(isset($params['class_id']))
        {
            $this->db->where('student.class_class_id', $params['class_id']);
        }

        if(isset($params['majors_id']))
        {
            $this->db->where('student.majors_majors_id', $params['majors_id']);
        }

        if(isset($params['period_id']))
        {
            $this->db->where('payment.period_period_id', $params['period_id']);
        }

        if(isset($params['status']))
        {
            $this->db->where('bulan.bulan_status', $params['status']);
        }

        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        $this->db->order_by('month_month_id', 'asc');

        $this->db->select('bulan.bulan_id, bulan_bill, bulan_date_pay, bulan_status, bulan_input_date, bulan_last_update');
        // $this->db->select('sum(bulan_bill) AS total');

        $this->db->select('student_student_id, student_img, student_nis, student_full_name, student_name_of_mother, student.class_class_id, student.majors_majors_id, majors_name, majors_short_name, class_name');
        $this->db->select('payment_payment_id, payment_type, pos_name, payment.pos_pos_id');

        $this->db->select('month_month_id, month_name');
        $this->db->select('bulan.student_student_id, bulan.student_student_id');
        $this->db->join('month', 'month.month_id = bulan.month_month_id', 'left');

        $this->db->join('student', 'student.student_id = bulan.student_student_id', 'left');
        $this->db->join('payment', 'payment.payment_id = bulan.payment_payment_id', 'left');
        $this->db->join('period', 'period.period_id = payment.period_period_id', 'left');
        $this->db->join('pos', 'pos.pos_id = payment.pos_pos_id', 'left');

        $this->db->join('class', 'class.class_id = student.class_class_id', 'left');
        $this->db->join('majors', 'majors.majors_id = student.majors_majors_id', 'left');
        $res = $this->db->get('bulan');

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

       if(isset($data['bulan_id'])) {
        $this->db->set('bulan_id', $data['bulan_id']);
    }

    if(isset($data['student_id'])) {
        $this->db->set('student_student_id', $data['student_id']);
    }

    if(isset($data['payment_id'])) {
        $this->db->set('payment_payment_id', $data['payment_id']);
    }

    if(isset($data['month_id'])) {
        $this->db->set('month_month_id', $data['month_id']);
    }

    if(isset($data['bulan_bill'])) {
        $this->db->set('bulan_bill', $data['bulan_bill']);
    }

    if(isset($data['bulan_number_pay'])) {
        $this->db->set('bulan_number_pay', $data['bulan_number_pay']);
    }

    if(isset($data['bulan_status'])) {
        $this->db->set('bulan_status', $data['bulan_status']);
    }

    if(isset($data['bulan_date_pay'])) {
        $this->db->set('bulan_date_pay', $data['bulan_date_pay']);
    }

    if(isset($data['user_user_id'])) {
        $this->db->set('user_user_id', $data['user_user_id']);
    }

    if(isset($data['bulan_input_date'])) {
        $this->db->set('bulan_input_date', $data['bulan_input_date']);
    }

    if(isset($data['bulan_last_update'])) {
        $this->db->set('bulan_last_update', $data['bulan_last_update']);
    }

    if (isset($data['bulan_id'])) {
        $this->db->where('bulan_id', $data['bulan_id']);
        $this->db->update('bulan');
        $id = $data['bulan_id'];
    } else {
        $this->db->insert('bulan');
        $id = $this->db->insert_id();
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

    // Get month from database
function get_month($params = array())
{
    if(isset($params['id']))
    {
        $this->db->where('month_id', $params['id']);
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
        $this->db->order_by('month_id', 'asc');
    }

    $this->db->select('month_id, month_name');
    $res = $this->db->get('month');

    if(isset($params['id']))
    {
        return $res->row_array();
    }
    else
    {
        return $res->result_array();
    }
}

function add_month($data = array()) {

        if (isset($data['month_id'])) {
            $this->db->set('month_id', $data['month_id']);
        }

        if (isset($data['month_name'])) {
            $this->db->set('month_name', $data['month_name']);
        }

        if (isset($data['month_id'])) {
            $this->db->where('month_id', $data['month_id']);
            $this->db->update('month');
            $id = $data['month_id'];
        } else {
            $this->db->insert('month');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete_month($id) {
        $this->db->where('month_id', $id);
        $this->db->delete('month');
    }

    // Delete to database
function delete($id) {
    $this->db->where('bulan_id', $id);
    $this->db->delete('bulan');
}

}
