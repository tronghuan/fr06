<?php

class comment_model extends MY_Model{
  
  protected $_primaryID;
  protected $_table;
  
  public function __construct()
  {
    parent::__construct();
    $this->_primaryID = 'comment_id';
    $this->_table = 'comment';
  }
  
  public function gets($review_id)
  {
    $result = array();
    if ($review_id)
    {
      $this->db->where('product_id', $review_id);
//      $this->db->where('comment_status != ', 0);
      $this->db->order_by('comment_like', 'DESC');
      $this->db->order_by('comment_date', 'DESC');
      $query = $this->db->get($this->_table);
      $result = $query->result_array();
    }
    return $result;
  }
  public function insert_comment($data)
  {
      $this->db->insert('comment', $data);
      $insert_id = $this->db->insert_id();
      return $insert_id;
  }
  public function total_comments($product_id)
  {
      $this->db->where('product_id', $product_id);
      $this->db->group_by('product_id');
      $this->db->select('SUM(comment_rate) as total_rate');
      $this->db->select('COUNT(product_id) as total_num');
      $this->db->from($this->_table);
      $query = $this->db->get();
      $result = $query->result_array();
      if (!empty($result))return $result[0];
      else return $result;
  }
  public function like($id)
  {
    $this->db->where($this->_primaryID, $id);
    $this->db->select('comment_like');
    $number = $this->db->get($this->_table);    
    $number = $number->result_array();
    if (!empty($number))$number = $number[0]['comment_like'];
    else $number = 0;
    $data = array(
      'comment_like' => $number + 1
    );
    $this->db->where($this->_primaryID, $id);
    $this->db->update($this->_table, $data);
    return $number + 1;
  }
  public function dis_like($id)
  {
    $this->db->where($this->_primaryID, $id);
    $this->db->select('comment_like');
    $number = $this->db->get($this->_table);    
    $number = $number->result_array();
    if (!empty($number))$number = $number[0]['comment_like'];
    else $number = 0;
    $data = array(
      'comment_like' => $number - 1
    );
    $this->db->where($this->_primaryID, $id);
    $this->db->update($this->_table, $data);
    return $number - 1;    
  }
}
