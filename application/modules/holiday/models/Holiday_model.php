<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	//Get from database

    var $table = 'holiday';
    
    public function get($params = array())
    {
        if(isset($params['id']))
        {
            $this->db->where('id', $params['id']);
        }
        if(isset($params['year']))
        {
            $this->db->where('year', $params['year']);
        }
        if(isset($params['date']))
        {
            $this->db->where('date', $params['date']);
        }

        if(isset($params['info']))
        {
            $this->db->where('info', $params['info']);
        }
        
        if(isset($params['date_start']) AND isset($params['date_end']))
        {
            $this->db->where('date >=', $params['date_start'].' 00:00:00');
            $this->db->where('date <=', $params['date_end'].' 23:59:59');
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
            $this->db->order_by('id', 'desc');
        }

        $res = $this->db->get('holiday');

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
        $param = array(
            'date' => $data['date'],
            'year' => $data['year'],
            'info' => $data['info'],
            );
        $this->db->set($param);

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('holiday');
            $id = $data['id'];
        } else {
            $this->db->insert('holiday');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }
    
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('holiday');
    }

    function get_holiday() {
        $libur = $this->get();

        $res_libur = array();
        foreach ($libur as $key) {
            $res_libur[] = $key['date'];
        }

        return $res_libur;
    }

    public function is_exist($field, $value)
    {
        $this->db->where($field, $value);        

        return $this->db->count_all_results('holiday') > 0 ? TRUE : FALSE;
    }
}

/* End of file Holiday_model.php */
/* Location: ./application/modules/holiday/models/Holiday_model.php */