<?php

class category_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_primaryID = 'category_id';
        $this->_table = 'category';
    }
    public function fetch_all(){
        return $this -> db -> get($this->_table);   
    }
    public function total(){
        return $this -> db -> count_all_results("category");
    }    
    public function listcategory($off,$start){
        $this->db->limit($off,$start);
        return $this->db->get($this->_table)->result_array();
    }
    public function find($name)
    {
        $this->db->where('category_name', $name);
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        if (count($result) < 0) return false;
        return $result;
    }
    public function insert_category($data)
    {
        $result = $this->db->insert($this->_table, $data);
        return $result;
    }
    public function get_from_parent($parentID)
    {
        $result = array();
        foreach ($parentID as $id) {
            $this->db->select('category_id');
            if ($id === NULL) {
                $this->db->where('category_parentid is NULL', null, false);
            } else $this->db->where('category_parentid', $id);
            $query = $this->db->get($this->_table);
            $temp = $query->result_array();
            foreach ($temp as $tmp) {
                $result[] = $tmp['category_id'];
            }
        }
        
        return $result;
    }
    
    public function get_all_category(){
        $this->db->select("*");
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    public function move_category($data){
        if(!empty($data)){
            $this->db->update_batch($this->_table, $data, $this->_category_id);
        }
    }
    public function set_order($data){
        if(!empty($data)){
            $this->db->update_batch($this->_table, $data, $this->_category_id);
        }
    }    
}