
<?php
/**
 * Created by PhpStorm.
 * user: TrongHuan
 * Date: 8/18/14
 * Time: 1:55 PM
 */
class Product_model extends MY_Model{
    protected $_table = "product";
    protected $_primaryID = "product_id";
    public  function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function getAllProduct(){
        return $this->db->get($this->_table)->result_array();
    }
    public function countAllProduct(){
        return $this->db->count_all_results($this->_table);
    }
    public function fetch_product($limit, $start){
        $this->db->limit($limit, $start);
        return $this->db->get($this->_table, $limit, $start)->result_array();
    }

        public function list_products($limit, $start, $order_by = 'ASC', $title = 'product_name', $search = '', $search_fields  = null, $categories = array())
        {
            $result = array ();
            if ($search !== '') {
                if (is_array($search_fields)) {
                    $i = 0;$total = 0;
                    if (empty ($categories)) {
                        $where = '';
                        foreach ($search_fields as $field) {
                            $where .= $field . ' ' . 'like '. '"%'.$search.'%"' . ' ' . 'OR ';
                        }
                    }else {
                        $where = '( ';
                            foreach ($search_fields as $field) {
                                $where .= $field . ' ' . 'like '. '"%'.$search.'%"' . ' ' . 'OR ';
                            }
                    }
                    mb_internal_encoding('utf-8');
                    $len = mb_strlen($where);
                    $where = mb_substr($where,0, $len-3);
                    $where .= empty($categories) ? '' : ' )';
                    $this->db->limit($limit, $start);
                    $this->db->order_by($title, $order_by);
                    $this->db->where($where);
                }else {
                    $this->db->limit($limit, $start);
                    $this->db->order_by($title, $order_by);
                    $this->db->like($search_fields, $search);
                }
            }else {
                $this->db->limit($limit, $start);
                $this->db->order_by($title, $order_by);
            }

            if (empty($categories)) {
                $query = $this->db->get($this->_table);
            }else {
                $this->db->from($this->_table);
                $this->db->join('productcategory', 'productcategory.product_id = product.product_id');
                $andWhere = '(';
                foreach($categories as $c) {
                    $andWhere .= 'category_id' . '="' .$c . '" OR ';
                }
                mb_internal_encoding('utf-8');
                $len = mb_strlen($andWhere);
                $andWhere = mb_substr($andWhere,0, $len-3);
                $andWhere .= ')';
                $this->db->where($andWhere);
                $query = $this->db->get();
            }
            // $this->db->group_by($this->_primaryID);
            $result = $query->result_array();
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
    public function total_records($titles = '', $var='', $categories = array())
    {
        $nums  = 0;
        if ($titles && $var) {
            if (is_array($titles)) {
               $i = 0;$total = 0;
                $where = empty($categories) ? '' : '( ';
                foreach ($titles as $title) {
                    $where .= $title . ' ' . 'like '. '"%'.$var.'%"' . ' ' . 'OR ';
                }
                mb_internal_encoding('utf-8');
                $len = mb_strlen($where);
                $where = mb_substr($where,0, $len-3);
                $where .= empty($categories) ?  '' : ')';
                $this->db->select($this->_primaryID);
                $this->db->where($where);
                $query = $this->db->get($this->_table);


            }else {
                $this->db->like($title, $var);
            }
        }else {
            $this->db->select($this->_table . '.' .$this->_primaryID);
        }

        if (empty($categories)) {
            $query = $this->db->get($this->_table);
        }else {
            $this->db->select($this->_table . '.' .$this->_primaryID);
            $this->db->from($this->_table);
            $this->db->join('productcategory', 'productcategory.product_id = product.product_id');
            $andWhere = '(';
            foreach($categories as $c) {
                $andWhere .= 'category_id' . '="' .$c . '" OR ';
            }
            mb_internal_encoding('utf-8');
            $len = mb_strlen($andWhere);
            $andWhere = mb_substr($andWhere,0, $len-3);
            $andWhere .= ')';
            $this->db->where($andWhere);
            $query = $this->db->get();
        }
        // $this->db->group_by($this->_primaryID);
        $nums = $query->num_rows();
        return $nums;
    }
    public function getProduct_Cate($id){
        $this->db->select('*');
        $this->db->from('productcategory');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getOnce($id){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getCountries(){
        $this->db->select('*');
        $this->db->from('country');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function update($data_product,$id){

        $this->db->where($this->_primary,$id);
        $this->db->update($this->_table, $data_product);
    }
    public function delete_re($id){
        $this->db->where($this->_primary,$id);
        $this->db->delete('productcategory');
    }
    public function update_category_product($value){
        $this->db->insert('productcategory',$value);
    }
    public function get_product_by_id($id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where("product_id", $id);
            $query = $this->db->get();
            return $query->result_array();
    }
}