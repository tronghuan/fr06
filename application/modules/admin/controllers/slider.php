<?php
	class Slider extends BaseAdminController {
		public function __construct() {
			parent::__construct ();
			$this->load->model ( 'slider_model' );
			$this->load->model ( 'product_model' );
			$this->load->model ('images_model');
			$this->load->helper ( 'url' );
			$this->load->library ( 'session' );
		}
		public function index() {
			/**
			* Ham lay thu tu cac slider
			* Neu ton tai slider thi in ra khong thi hien ra thong bao chen slider
			*
			*/
			$data ['title'] = 'Choose slider';
			// $data ['template'] = 'slider/slider_select';
			$data['image'] = $this->images_model->getAllImage();
			$data['slider'] = $this->slider_model->get_slider_order();
			foreach($data['slider'] as $key => $rs){
            foreach($data['image'] as $img){
                if($rs['img_link'] == $img['image_id']){
                    $data['slider'][$key]['image_name'] = $img['image_name'];
                }
            }
        }
			// echo "<pre>";print_r($data['order']);die();
			$this->layout->view ( "slider/slider_select", $data );
		}
		
		public function setOrder(){
			/**
			* Sau khi keo slider thi phai update lai thu tu slider trong database
			*/
			$update = $_POST['data'];
			$this->slider_model->update_slider($update);
		}
		public function add_delete_slider(){
    	$product_id = $_GET['pro_id'];
    	// echo $product_id;die();
    	if(count($this->slider_model->get_slider_by_pro_id($product_id))>0){
    		$this->slider_model->delete_slider($product_id);
    	}else{
    		$product = $this->product_model->get_product_by_id($product_id);
    		// print_r($product);die();
    		$slider_link = $product[0]['product_mainImageId'];

    		$this->slider_model->insert_slider($product_id,$slider_link);
    	}
    		redirect(base_url("admin/product/index/0"), 'refresh');
    	}
	}