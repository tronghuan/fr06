<?php
    class Brand_model extends CI_Model{
        protected $_primaryID = 'brand_id';
        protected $_table = 'brand';
        public function fetch_all(){
            return $this->db->query("select * from brand");   
        }
        public function total(){
            return $this -> db -> count_all_results("brand");
        }
        public function listbran($off,$start){
		$this->db->limit($off,$start);
		return $this->db->get($this->_table)->result_array();
        }
        public function update($id, $data){
            $this->db->where($this->_primaryID,$id);
            $this->db->update($this->_table, $data);
        }
        
        public function getOnce($id){
            $this->db->select('*');
            $this->db->from('brand');
            $this->db->where('brand_id', $id);
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        }
		public function get_all_brand(){
			$this->db->select("*");
			$query = $this->db->get($this->_table);
			$result = array();
			foreach($query->result_array() as $value){
				$result[] = array(
					"brand_id" => $value['brand_id'],
					"brand_name" => $value['brand_name'],
                    "brand_desc" => $value['brand_desc'],
				);
			}
			return $result;
		}

    public function delete($id){

    }
		
    }
?>