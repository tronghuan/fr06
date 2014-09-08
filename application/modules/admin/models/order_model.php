<?php

class Order_model extends MY_Model
{
  protected $_table;
  protected $_primaryID;

  public function __construct()
  {
    $this->_table ='order';
    $this->_primaryID = 'order_id';
  }
  public function ($startDate , $endDate, $limit, $start, $order_by = 'ASC', $title = 'order_date', $search = '', $search_fields  = null)
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
            $this->db->where(" `order_date` >= " . $startDate . ' AND ' . ' `order_date` <= ' . $endDate . ' ',  null, false);
            $query = $this->db->get($this->_table);
            $result = $query->result_array();
        }else {
            $this->db->where("`order_date` >= " . $startDate . ' AND ' . ' `order_date` <= ' . $endDate . ' ',  null, false);
            $this->db->limit($limit, $start);
            $this->db->order_by($title, $order_by);
            $this->db->like($search_fields, $search);
            $query = $this->db->get($this->_table);
            $result = $query->result_array();
        }
    }else {
        $this->db->where("`order_date` >= " . $startDate . ' AND ' . ' `order_date` <= ' . $endDate . ' ',  null, false);
        $this->db->limit($limit, $start);
        $this->db->order_by($title, $order_by);
        $query = $this->db->get($this->_table);
        $result = $query->result_array();
    }
    return $result;
  }
  public function get_order_product_from_to($startDate, $endDate)
  {
    // make a query a
    $this->db->select('*, sum(orderdetail.order_quantity) as nums');
    $this->db->where('`order_date` >="' . $startDate. '"' , null, false);
    $this->db->where('`order_date` <="' . $endDate .'"', null, false);
    $this->db->from('order');
    $this->db->join('orderdetail', 'orderdetail.order_id = order.order_id');
    $this->db->order_by('nums', 'DESC');
    $this->db->group_by(array('orderdetail.product_id', 'orderdetail.order_id'));
    $query = $this->db->get();
    $result_a = $query->result_array();
    return $result_a;
  }
  public function get_product_order_from_to($startDate, $endDate, $limit, $start) {
    // make a query b
    $this->db->select('product.*, sum(orderdetail.order_quantity) as nums');
    $this->db->where('`order_date` >="' . $startDate. '"' , null, false);
    $this->db->where('`order_date` <="' . $endDate .'"', null, false);
    $this->db->from('order');
    $this->db->join('orderdetail', 'orderdetail.order_id = order.order_id');
    $this->db->join('product', 'product.product_id = orderdetail.product_id');
    $this->db->order_by('nums', 'DESC');
    $this->db->limit($limit, $start);
    $this->db->group_by(array('orderdetail.product_id'));
    $query = $this->db->get();
    $result_b = $query->result_array();
    return $result_b;
  }
  public function total_records($startDate, $endDate)
  {
    $this->db->select('product_id, sum(orderdetail.order_quantity) as nums');
    $this->db->where('`order_date` >="' . $startDate. '"' , null, false);
    $this->db->where('`order_date` <="' . $endDate .'"', null, false);
    $this->db->from('order');
    $this->db->join('orderdetail', 'orderdetail.order_id = order.order_id');
    $this->db->order_by('nums', 'DESC');
    $this->db->group_by(array('orderdetail.product_id'));
    $query = $this->db->get();
    $result_c = $query->num_rows();
    return $result_c;
  }
  public function get_product_category ($startDate, $endDate)
  {
    // make a query d
    $this->db->select('orderdetail.product_id, productcategory.category_id, sum(orderdetail.order_quantity) as nums');
    $this->db->where('`order_date` >="' . $startDate. '"' , null, false);
    $this->db->where('`order_date` <="' . $endDate .'"', null, false);
    $this->db->from('order');
    $this->db->join('orderdetail', 'orderdetail.order_id = order.order_id');
    $this->db->join('productcategory', 'orderdetail.product_id = productcategory.product_id');
    $this->db->order_by('nums', 'DESC');
    $this->db->group_by(array('orderdetail.product_id', 'productcategory.product_id'));
    $query = $this->db->get();
    $result_d = $query->result_array();
    return $result_d;
  }

}