<?php
    class Brand_model extends MY_Model{
    	protected $_table = "brand";
    	public  function __construct(){
	        parent::__construct();
	        $this->load->database();
        }
        public function getAllBrand(){
			$this->db->select("*");
			$query = $this->db->get($this->_table);
			$result = array();
			foreach($query->result_array() as $value){
				$result[] = array(
					"brand_id" => $value['brand_id'],
					"brand_name" => $value['brand_name'],
				);
			}
			return $result;
		} 
    }
?>