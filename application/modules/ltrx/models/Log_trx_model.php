<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_trx_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {
        if (isset($params['id'])) {
            $this->db->where('log_trx.log_trx_id', $params['id']);
        }

        if (isset($params['bulan_id'])) {
            $this->db->where('bulan_bulan_id', $params['bulan_id']);
        }

        if (isset($params['bebas_pay_id'])) {
            $this->db->where('bebas_pay_bebas_pay_id', $params['bebas_pay_id']);
        }

        if (isset($params['payment_id'])) {
            $this->db->where('payment_payment_id', $params['payment_id']);
        }

        if (isset($params['student_id'])) {
            $this->db->where('log_trx.student_student_id', $params['student_id']);
        }

        if (isset($params['student_nis'])) {
            $this->db->where('student_nis', $params['student_nis']);
        }


        if (isset($params['log_trx_input_date'])) {
            $this->db->where('log_trx_input_date', $params['log_trx_input_date']);
        }

        if (isset($params['log_trx_last_update'])) {
            $this->db->where('log_trx_last_update', $params['log_trx_last_update']);
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
            $this->db->order_by('log_trx_id', 'desc');
        }
        $this->db->select('log_trx.log_trx_id, log_trx_input_date, log_trx_last_update');
        $this->db->select('bulan_bulan_id, log_trx.student_student_id, student_nis, bulan_bill, month_name, bebas_pay_bill');

        $this->db->select('posMonth.pos_name AS posmonth_name, posBebas.pos_name AS posbebas_name, periodMonth.period_start AS period_start_month, periodMonth.period_end AS period_end_month');
        $this->db->select('periodBebas.period_start AS period_start_bebas, periodBebas.period_end AS period_end_bebas');

        $this->db->join('bulan', 'bulan.bulan_id = log_trx.bulan_bulan_id', 'left');
        $this->db->join('month', 'month.month_id = bulan.month_month_id', 'left');
        $this->db->join('bebas_pay', 'bebas_pay.bebas_pay_id = log_trx.bebas_pay_bebas_pay_id', 'left');
        $this->db->join('bebas', 'bebas.bebas_id = bebas_pay.bebas_bebas_id', 'left');
        $this->db->join('student', 'student.student_id = log_trx.student_student_id', 'left');
        $this->db->join('payment AS payMonth', 'payMonth.payment_id = bulan.payment_payment_id', 'left');
        $this->db->join('payment AS payBebas', 'payBebas.payment_id = bebas.payment_payment_id', 'left');
        $this->db->join('pos AS posMonth', 'posMonth.pos_id = payMonth.pos_pos_id', 'left');
        $this->db->join('pos AS posBebas', 'posBebas.pos_id = payBebas.pos_pos_id', 'left');
        $this->db->join('period AS periodMonth', 'periodMonth.period_id = payMonth.period_period_id', 'left');
        $this->db->join('period AS periodBebas', 'periodBebas.period_id = payBebas.period_period_id', 'left');
        

        $res = $this->db->get('log_trx');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    // Insert some data to table
    function add($data = array()) {

        if (isset($data['log_trx_id'])) {
            $this->db->set('log_trx_id', $data['log_trx_id']);
        }

        if (isset($data['bulan_bulan_id'])) {
            $this->db->set('bulan_bulan_id', $data['bulan_bulan_id']);
        }

        if (isset($data['bebas_pay_bebas_pay_id'])) {
            $this->db->set('bebas_pay_bebas_pay_id', $data['bebas_pay_bebas_pay_id']);
        }

        if (isset($data['student_student_id'])) {
            $this->db->set('student_student_id', $data['student_student_id']);
        }

        if (isset($data['log_trx_input_date'])) {
            $this->db->set('log_trx_input_date', $data['log_trx_input_date']);
        }

        if (isset($data['log_trx_last_update'])) {
            $this->db->set('log_trx_last_update', $data['log_trx_last_update']);
        }


        if (isset($data['log_trx_id'])) {
            $this->db->where('log_trx_id', $data['log_trx_id']);
            $this->db->update('log_trx');
            $id = $data['log_trx_id'];
        } else {
            $this->db->insert('log_trx');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

      // Delete log_trx to database
    function delete($id) {
        $this->db->where('log_trx_id', $id);
        $this->db->delete('log_trx');
    }

      // Delete log_trx to database
    function delete_log($params = array()) {
        
        if (isset($params['bulan_id'])) {
            $this->db->where('bulan_bulan_id', $params['bulan_id']);
        }

        if (isset($params['bebas_pay_id'])) {
            $this->db->where('bebas_pay_bebas_pay_id', $params['bebas_pay_id']);
        }

        if (isset($params['student_id'])) {
            $this->db->where('log_trx.student_student_id', $params['student_id']);
        }

        $this->db->delete('log_trx');
    }

}

/* End of file Log_trx_model.php */
/* Location: ./application/modules/ltrx/models/Log_trx_model.php */