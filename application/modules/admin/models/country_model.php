<?php
/**
 * Created by PhpStorm.
 * User: TrongHuan
 * Date: 8/18/14
 * Time: 1:56 PM
 */ 
class Country_model extends CI_Model{
	protected $_table= "country";
	public function __construct(){

	}
	public function getAllCountry(){
		$this->db->select("*");
        $query = $this->db->get($this->_table);
        $result = array();
        foreach($query->result_array() as $value){
            $result[] = array(
                "country_id" => $value['country_id'],
                "country_name" => $value['country_name'],
            );
        }
        return $result;
	}
  
}