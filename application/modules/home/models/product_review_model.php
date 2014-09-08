<?php

class product_review_model extends MY_Model{
  
  protected $_primaryID;
  protected $_table;
  
  public function __construct()
  {
    parent::__construct();
    $this->_primaryID = 'product_review_id';
    $this->_table = 'product_review';
  }
  
  public function gets($review_id)
  {
    $result = array();
    if ($review_id)
    {
      $this->db->where($this->_primaryID, $review_id);
      $query = $this->db->get($this->_table);
      $result = $query->result_array();
    }
    return $result;
  }
}
