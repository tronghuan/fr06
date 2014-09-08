<?php
class Home extends BaseHomeController{
    
	public function __construct(){
		parent::__construct();
        $this->load->model('product_model');
        $this->load->model('images_model');
	}
	public function index(){
        $data['title'] = 'Home page';
        $limit = 4; 
        $data_get['new_product']= $this->product_model->get_new_product($limit);
        $data['new_product'] = array();
        foreach($data_get['new_product'] as $product){
        if ($product['product_mainImageId'] != null){
              $src=  $this->images_model->get_images($product['product_id'],$product['product_mainImageId']); 
            }else{
              $src = 0;
            }
           if($src != 0){
                $src_s= '<img class="thumbnail" width="150px" height="150px" src="'.$src[0]['url'].'" alt= />';
               
            }else{
               $src_s = '<img width="150px" height="150px" src="'. base_url('public/home/assets/img/no-image.png') .'" >';
            }
          
                $data['new_product'][] = array(
                "product_id" => $product['product_id'],
                "product_name" => $product['product_name'],
                "product_price" => $product['product_price'],
                "product_mainImageId" => $src_s
          );
          
         };
         $data_get['sale_product']= $this->product_model->get_sale_product();
        
         foreach($data_get['sale_product'] as $product_s){
            if ($product['product_mainImageId'] != null){
              $src=  $this->images_model->get_images($product_s['product_id'],$product_s['product_mainImageId']); 
            }else{
              $src = 0;
            }
           if($src != 0){
                $src_s= '<img class="thumbnail" width="150px" height="150px" src="'.$src[0]['url'].'" alt= />';
               
            }else{
               $src_s = '<img width="150px" height="150px" src="'. base_url('public/home/assets/img/no-image.png') .'" >';
            }
          
                $data_new['sale_product'][] = array(
                "product_id" => $product_s['product_id'],
                "product_name" => $product_s['product_name'],
                "product_price" => $product_s['product_price'],
                "product_mainImageId" => $src_s
          );
               
              $rand = array_rand($data_new['sale_product']);

         };
         $data['sale_product'][]=$data_new['sale_product'][$rand];
         

         $this->layout->view('layouts/center',$data);
         
        
	}
}