<?php

class User_model extends MY_Model{
    protected $_table = 'user';
    protected $_primaryID = 'user_id';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function list_users($limit, $start, $order_by = 'ASC', $title = 'user_name', $search = '', $search_fields  = null)
    {
        $result = array ();
        if ($search !== '') {
            if (is_array($search_fields)) {
                $i = 0;$total = 0;
                $where = '';
                foreach ($search_fields as $field) {
                    $where .= $field . ' ' . 'like '. '"%'.$search.'%"' . ' ' . 'OR ';  
                }
                mb_internal_encoding('utf-8');
                $len = mb_strlen($where);
                $where = mb_substr($where,0, $len-3);
                
                $this->db->limit($limit, $start);
                $this->db->order_by($title, $order_by);
                $this->db->where($where);
                $query = $this->db->get($this->_table);
                
                $result = $query->result_array();                
            }else {
                $this->db->limit($limit, $start);
                $this->db->order_by($title, $order_by);
                $this->db->like($search_fields, $search);
                $query = $this->db->get($this->_table);
                $result = $query->result_array();
            }
        }else {
            $this->db->limit($limit, $start);
            $this->db->order_by($title, $order_by);
            $query = $this->db->get($this->_table);
            $result = $query->result_array();
        }
        return $result; 
    }
    public function get_likes($title, $match, $order, $title, $limit)
    {
        $ret = array (
            'rows' => '',
            'result' => '',
        );
        $this->db->order_by($title,$order);
        $this->db->limit($limit);
        $this->db->like($title, $match);
        $query = $this->db->get($this->_table);
        $ret['result'] = $query->result_array();
        $ret['rows'] = $query->num_rows();
        return $ret;
    }
    public function total_records($titles = '', $var='')
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
     public function deleteUser($id){
        $this->db->where($this->_primaryID,$id);
        $this->db->delete($this->_table);
    }
    
    public function insert($data1){
         $this->db->insert('user', $data1);
    }
    public function fetch_all(){
        $sql = 'select * from user';
        return $this->db->query($sql);
    }
    public function getAll(){
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
        return $result;
    }
    public function getOnce($id){
        $this->db->where("user_id = $id");
        return $this->db->get($this->_table)->row_array();
    }
    public function getUserUpdate($id){

    }
    public function checkUserName($usr_name){

    }
    public function checkEmail($usr_email){

    }
    public function count_all(){

    }
    public function get_order($column, $sortType = '', $limit = '', $start = ''){

    }
    public function updateUser($data, $user_id = ''){

    }
    public function isValidate($dataUser){
        // $data = $this->db->select()->where('user_name',$dataUser['username'])->where('user_password',$dataUser['password'])
        //     ->get($this->_table)->row_array();
        // // echo $data;
        // if(count($data)>0){
        //     return $dataUser;
        // }else{
        //     return false;
        // }
        $data = $this->getAll();
        foreach($data as $key => $value){
            if(in_array($dataUser['username'], $value) && in_array($dataUser['password'], $value)){
                return true;
            }
        }
        return false;
    }    
    
}
