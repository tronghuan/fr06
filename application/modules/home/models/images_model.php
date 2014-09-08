<?php
class images_model extends CI_Model{
    protected $_gallery_path = "";
    protected $_gallery_url = "";
    public function __construct(){
        parent::__construct();

        $this->_gallery_url = base_url()."public/images/product/";
        $this->_gallery_path = realpath(APPPATH. "../public/images/product");
        $this->load->helper('file');
    }
     public function getMainImages($image_id){
        $this->db->select('*');
        $this->db->from('image');
        $this->db->where('image_id =', $image_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function getAllImages($id){
        $this->db->select('*');
        $this->db->from('image');
        $this->db->where('product_id =', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function count_image($id){
            $this->db->from('image');
            $this->db->where('product_id =', $id);
            $count = $this->db->count_all_results();
                return $count;
    }
    public function get_images($id,$image_id){
        $images_main = $this->getMainImages($image_id);
        foreach($images_main as $imagess);
        $image_name= $imagess['image_path'];
        $link = $this->_gallery_url .$id;
        $image_main = array();
        $image_main[] = array("url"        =>  $link.'/'.$image_name,
                "thumb_url" => $link.'/' . "temp/" . $image_name,
                "name" => $image_name);
        return $image_main;
    }
    public function get_images_other($id){
        $images_all = $this->getAllImages($id);
        $images = array();
        if($images_all == NULL){
           $images == NULL;
           return $images;
        }else{
            foreach($images_all as $imagess){
                $images_info[]= array ( "name" => $imagess['image_path'],
                    "image_id" => $imagess['image_id']);
            };
            $link = $this->_gallery_url .$id;

            foreach($images_info as  $value  ){

                $images[] = array("url"        =>  $link.'/'.$value['name'],
                    "thumb_url" => $link.'/' . "temp/" . $value['name'],
                    "name_img" => $value['name'],
                    "image_id" => $value['image_id']   );
            };
            return $images;
        }
    }
    //Acc1 Start
    public function get_all_image(){
        $this->db->select('*');
        $this->db->from('image');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    // Acc1 End
}