<?php
class images_model extends MY_Model{
    protected $_table = "image";
    protected $_gallery_path = "";
    protected $_gallery_url = "";
    public function __construct(){
        parent::__construct();

        $this->_gallery_url = base_url()."public/images/product/";
        $this->_gallery_path = realpath(APPPATH. "../public/images/product");
        $this->load->helper('file');
    }

    public function getAllImage(){//ham nay cho slider
        $this->db->select("*");
        $query = $this->db->get($this->_table);
        $result = array();
        foreach($query->result_array() as $value){
            $result[] = array(
                "image_id" => $value['image_id'],
                "image_name" => $value['image_path'],
            );
        }
        return $result;
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
    public function get_upload_folder($id)
    {
        $ret = $this->_gallery_path .'/'.$id;
        return $ret;
    }
    public function do_upload($id){

        $path = $this->get_upload_folder($id);
        if(!is_dir($path)){
            mkdir($path, TRUE);
        }
        $config = array('upload_path'   => $path,
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '2000');
        $this->load->library("upload",$config);

            if(!$this->upload->do_upload("images")){
            $error = array($this->upload->display_errors());
        }else{
        $image_data = $this->upload->data();
}       if(!is_dir($path.'/temp')){
            mkdir($path.'/temp', TRUE);
        }
        $config = array("source_image" => $image_data['full_path'],
            "new_image" => $path . "/temp",
            "maintain_ration" => true,
            "width" => '150',
            "height" => "100");
        $this->load->library("image_lib",$config);
        $this->image_lib->resize();

        $image_name =  $image_data['file_name'];
        $info = array(
            "product_id" => $id,
            "image_path" => $image_name
        );
        $this->db->insert('image',$info);
        return $image_name;

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
    public function del_id($image_id){
           $this->db->where('image_id', $image_id);
           $this->db->delete('image');
    }
    public function del_image($name,$product_id){
            $link = $this->_gallery_path.'/'.$product_id.'/'.$name;
            $link_thumbs = $this->_gallery_path.'/'.$product_id.'/temp/'.$name;
                @unlink($link);
                @unlink($link_thumbs);
    }
}