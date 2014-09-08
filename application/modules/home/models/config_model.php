<?php
class config_model extends CI_Model{
    public  function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function getAll(){
        $this->db->select('*');
        $this->db->from('config');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }
    public function number_item_per_page(){
        $this->db->select('config_value');
        $this->db->from('config');
        $this->db->where('config_name', 'number_item_per_page');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;

    }
    public function number_per_page(){
        $this->db->select('*');
        $this->db->where('config_name', 'number_product_per_page');
        $this->db->from('config');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function update($data, $field_name){
        $this->db->where('config_name', $field_name);
        $this->db->update('config',$data);
    }
    public function get_config($name)
    {
        $this->db->where('config_name', $name);
        $query = $this->db->get('config');
        $result = $query->result_array();
        if (! empty($result))return $result[0];
        else return $result;
    }
}
?>