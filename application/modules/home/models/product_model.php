<?php
    class Product_model extends MY_Model{
        protected $_primaryID = 'product_id';
        protected $_table= 'product';
        protected $_limit = '';
        protected $_start = '';

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
        public function get_new_product($limit){
            $this->db->select('product_name ,product_id,product_mainImageId,product_price,product_sale');
            $this->db->order_by('product_date desc');
            // limit set:
            if($limit == NULL || $limit == 0){
            $this->db->limit($this->_limit);
            }else{
            $this->db->limit($limit);
            }
            // End limit
            $this->db->from($this->_table) ;
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        public function get_all_new_product($per_page, $offset){
            $this->db->select('product_name ,product_id,product_mainImageId,product_price,product_sale');
            $this->db->order_by('product_date desc');
            $this->db->limit($per_page, $offset);
            $this->db->from($this->_table) ;
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;

        }
        public function get_sale_product(){
            $this->db->select('product_name,product_id,product_mainImageId,product_price,product_sale');
            $this->db->order_by('product_sale desc');
            $this->db->from($this->_table) ;
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }

        /**
         * Get all products compare to filter of product
         * @param	object	$limit			#limit var
         * @param	object	$start			start of limit query , default = 0
         * @param	String	$order_by		Ascending or descending
         * @param	String	$title			field to sort
         * @param	String	$search			search name
         * @param	Object	$search_fields	array fields to be search
         * @param	Object	$categories		categories to be search
         * @param	Object	$brands			Brands for seach
         * @param	Object	$other_where	it's depend may be 'product_price *( 1 - product_sale) > min min AND product_price *(1 - product_sale) < max '
            * @return	object					products fit filter
            */
        public function list_products($limit, $start, $order_by = 'ASC', $title = 'product_name', $search = '', $search_fields  = null, $categories = array(), $brands = array(), $other_where = array(), $ext = 'AND')
        {
            $this->db->select(' ROUND((product.product_price * (100 - product.product_sale) / 100)) as sale_price , product.product_name, product.product_desc, product.product_id, product.product_date, product.product_mainImageId, product.brand_id, product.country_id, product.product_price, product.product_sale');
            if ($title == 'product_price') {                
                $title = 'sale_price';
            }
            $result = array ();
            if ($search !== '') {
                if (is_array($search_fields)) {
                    $i = 0;$total = 0;
                    if (empty ($categories) && empty($brands) && empty($other_where)) {
                        $where = '';
                        foreach ($search_fields as $field) {
                            $where .= $field . ' ' . 'like '. '"%'.$search.'%"' . ' ' . 'OR ';
                        }
                    }else {
                        echo '1';
                        $where = '( ';
                            foreach ($search_fields as $field) {
                                $where .= $field . ' ' . 'like '. '"%'.$search.'%"' . ' ' . 'OR ';
                            }
                    }
                    mb_internal_encoding('utf-8');
                    $len = mb_strlen($where);
                    $where = mb_substr($where,0, $len-3);
                    $where .= empty($categories) && empty($brands) && empty($other_where)? '' : ' )';
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

            if (empty($categories) && empty($brands) && empty($other_where)) {
                $query = $this->db->get($this->_table);
            }else {
                if (! empty($categories)) {
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
                }
                if (! empty($brands)) {
                    $andWhereBrand = '(';
                    foreach($brands as $brand) {
                        $andWhereBrand .= 'brand_id' . '="' .$brand . '" OR ';
                    }
                    mb_internal_encoding('utf-8');
                    $len = mb_strlen($andWhereBrand);
                    $andWhereBrand = mb_substr($andWhereBrand,0, $len-3);
                    $andWhereBrand .= ')';
                    $this->db->where($andWhereBrand);
                }
                if (! empty($other_where)) {
                    $otherWhere = '(';
                    foreach($other_where as $other) {
                        $otherWhere .= $other . ' ' . $ext . ' ';
                    }
                    mb_internal_encoding('utf-8');
                    $len = mb_strlen($otherWhere);
                    $otherWhere = ($ext == 'OR') ? mb_substr($otherWhere,0, $len-3) : mb_substr($otherWhere,0, $len-4);
                    $otherWhere .= ')';
                    $this->db->where($otherWhere);
                }
                $this->db->group_by('product.product_id');
                $query = $this->db->get();
            }
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
        $this->db->group_by('product.product_id');
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
        $nums = $query->num_rows();
        return $nums;
        }
        
        public function gets($product_id )
        {
            $result = array();
            if ($product_id) {
                $this->db->where($this->_primaryID, $product_id);
                $query = $this->db->get($this->_table);
                $result = $query->result_array();
            }
            if (empty($result))return $result[0];
            else return $result;
        }
        public function search($product_search_fields, $search_name, $deep = false)
        {
            $this->db->from('product');
            if ($deep) {
                $this->db->join('productcategory','productcategory.product_id = product.product_id');
                $this->db->join('category','category.category_id = productcategory.category_id');
                $this->db->join('brand','brand.brand_id = product.brand_id');                
            }            
            if (is_array ($product_search_fields))
            {
                $i = 0;
                foreach ($product_search_fields as $field){                
                    if ($i ++ != 0)$this->db->or_like($field, $search_name);
                    else $this->db->like($field, $search_name);
                }
            }            
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
        // Acc1 Start
        public function count_all_product($range_price, $brand_id){
            $this->db->select('product_name,product_id,product_mainImageId,product_price,product_sale');
            $this->db->from($this->_table) ;
            $this->db->where('product_price >', $range_price['min']);
            $this->db->where('product_price <', $range_price['max']);
            if($brand_id != null){
                $this->db->where_in('brand_id', $brand_id);
            }
            $count_all = $this->db->get()->num_rows();
            return $count_all;
        }
        public function get_all_product($range_price, $brand_id, $start, $limit){
            $this->db->select('product_name,product_id,product_mainImageId,product_price,product_sale');
            $this->db->from($this->_table) ;
            $this->db->where('product_price >', $range_price['min']);
            $this->db->where('product_price <', $range_price['max']);
            if($brand_id != null){
                $this->db->where_in('brand_id', $brand_id);
            }
            $this->db->limit($limit, $start);
            $result = $this->db->get()->result_array();
            return $result;
        }
        // Acc1 End
    }
?>