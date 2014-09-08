<?php

class MY_Model extends CI_Model
{
    protected $_table;
    protected $_primaryID;
    protected $_result;
    
    public function __construct()
    {
        parent::__construct();
    }
    public function gets($id = '',$limit='', $start = 0, $order_by = 'ASC', $title = '')
    {
        if ($id !== '') $this->db->where($this->_primaryID, $id);
        if ($limit !== '') $this->db->limit($start, $limit);
        if ($title !== '') $this->db->order_by($title, $order_by);
        $this->_result = $query = $this->db->get($this->_table);
        return $this->_result->result_array();
    }
    
    public function total_records($title = '', $var = '')
    {
        $nums  = 0;
        if ($titles && $var) {
            if (is_array($titles)) {
               $i = 0;$total = 0;
                $where = '';
                foreach ($titles as $title) {
                    $where .= $title . ' ' . 'like '. '"%'.$var.'%"' . ' ' . 'OR ';  
                }
                mb_internal_encoding('utf-8');
                $len = mb_strlen($where);
                $where = mb_substr($where,0, $len-3);
                $this->db->select($this->_primaryID);
                $this->db->where($where);
                $query = $this->db->get($this->_table);
                
                $result = $query->result_array();
                $nums = $query->num_rows();
            }else {
                $this->db->like($title, $var);
                $query = $this->db->get($this->_table);
                $nums = $query->num_rows();                
            }
        }else {
            $this->db->select($this->_primaryID);
            $query = $this->db->get($this->_table);
            $nums = $query->num_rows();
        }
        return $nums;
    }
    
}