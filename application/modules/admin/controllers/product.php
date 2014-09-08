<?php
/**
 * Created by PhpStorm.
 * User: TrongHuan
 * Date: 8/18/14
 * Time: 1:54 PM
 */
class Product extends BaseAdminController{
    public static $_searchName;
    public static $_searchType;

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('product_model');
        $this->load->model('images_model');
        $this->load->model('category_model');
        $this->load->model('slider_model');
        $this->load->model('brand_model');
        $this->load->model('country_model');
        $this->load->library('pagination');
        $this->load->library('my_paginationer');
    }
    public function index($start = 0,$order = 'ASC', $title='product_name', $limit = '', $ajax = false, $search = ''){

            /*
             * make static vars
             */
        $countrys= $this->country_model->getAllCountry();
        $brands = $this->brand_model->get_all_brand();
        $images = $this->images_model->getAllImage();
        $product_search_fields = array ('product_name', 'product_desc', 'product_price');
        $search = $this->session->flashdata('searchs');
        if ($start < 0  || ! is_numeric($start)) {
          $this->data['errors'][] = 'index không có sẵn';
        }
        if (isset($_POST['btnok'])) {
          $title = $this->input->post('search_name');
          $order = $this->input->post('type_search');
        } else {
          if ($this->session->flashdata('product_search_name') != FALSE){
            $title = $this->session->flashdata('product_search_name');
          }
          if ($this->session->flashdata('product_search_type') != FALSE){
            $order = $this->session->flashdata('product_search_type');
          }
        }
        self::$_searchName = $title;
        self::$_searchType = $order;
        $limit = $this->session->flashdata('product_limit');
        $limit = $limit ? $limit : 3 ;

        // change vars if ajax call
        if (isset ($_REQUEST['ajax']) && $_REQUEST['ajax']) {
          $key = isset($_REQUEST['key']) && $_REQUEST['key'] != null ? $_REQUEST['key'] : '';
          $value = isset($_REQUEST['value']) && $_REQUEST['value'] != null ? $_REQUEST['value'] : '';
          $n = count ($key);
          $remember = $limit;
          for ($i = 0 ; $i < $n; $i ++){
            $$key[$i] = $value[$i];
          }
          if ($limit > $remember)
            $start -= ($limit - $remember);
          $start = ($start >= 0) ? $start : 0;
          if ($search !==  $this->session->set_flashdata('searchs', $search)){
            $start = 0;
            $this->session->set_flashdata('searchs', $search);
          }
        }
        // prepare for layout
        $this->session->set_flashdata('product_limit', $limit);

        $this->data['page_title'] = 'Danh sách 	người dùng';
        $this->data['i'] = $start;
        //prepare for pagination
        $this->my_paginationer->set_base_url(base_url() . 'admin/product/index');
        if ($search !== '')
        	$this->my_paginationer->set_total_number($this->product_model->total_records($product_search_fields, $search));
        else
        	$this->my_paginationer->set_total_number($this->product_model->total_records($product_search_fields, $search));
        $this->my_paginationer->set_per_page($limit);
        $links = $this->my_paginationer->page_links($start);
        $this->data['links'] = $links;
        $this->data['limit'] = $limit;
        $this->data['slider'] = $this->slider_model->get_slider_order();
        $this->data['results'] = $this->product_model->list_products($limit, $start, $order , $title, $search, $product_search_fields);
        foreach($this->data['results'] as $key => $rs){
            foreach($images as $img){
                if($rs['product_mainImageId'] == $img['image_id']){
                    $this->data['results'][$key]['image_name'] = $img['image_name'];
                }
            }
        }
        //echo "<pre>"; print_r($this->data['results']);die();
        foreach ($this->data['results'] as $key => $value) {
            $this->data['results'][$key]['product_date'] = date('m-d-Y',$this->data['results'][$key]['product_date']);
            $src = $this->data['results'][$key]['product_mainImageId'] != null ? $this->images_model->get_images($this->data['results'][$key]['product_id'],$this->data['results'][$key]['product_mainImageId']) : 0;
            $src = $src != 0 ?  '<img class="thumbnail" width="150px" height="150px" src="'.$src[0]['url'].'" alt= />' : '<img width="150px" height="150px" src="'. base_url('public/home/assets/img/no-image.png') .'" >';
            $this->data['results'][$key]['product_mainImageId'] = $src;
        }
        foreach($this->data['results'] as $key => $value){
            foreach($brands as $brand){
                if($brand['brand_id'] == $value['brand_id']){
                    $this->data['results'][$key]['brand_name'] = $brand['brand_name'];
                }
            }
        }
        foreach($this->data['results'] as $key => $value){
            foreach($countrys as $country){
                if($country['country_id'] == $value['country_id']){
                    $this->data['results'][$key]['country_name'] = $country['country_name'];
                }
            }
        }
        if ($ajax) {
        	$ret['links'] = $this->data['links'];
        	$ret['listProducts'] = $this->data['results'];
        	$ret['i'] = $this->data['i'];
        	echo json_encode($ret); // echo json to ajax
        }else
            //echo "<pre>"; print_r($this->data);die();
            $this->layout->view("product/listProduct", $this->data);
    }

    public function update(){
     $id = $this->uri->segment(4);
        $data['single_product'] = $this->product_model->getOnce($id);
        $data['list_category']=$this->category_model->get_all_category();
        $data['list_brand']=$this->brand_model->get_all_brand();
        $data['check_cate']=$this->product_model->getProduct_Cate($id);
        $data['countries']=$this->product_model->getCountries();
        foreach ($data['single_product'] as $product);
        $image_id = $product['product_mainImageId'];
        $data['image_all'] = $this->images_model->get_images_other($id);
        $data['count']= $this->images_model->count_image($id);
        if($image_id !== NULL){
            $data['image_main'] = $this->images_model->get_images($id,$image_id);
        }
        if($data['image_all'] == NULL){
            unset($data['image_all']);
        }else{
            $data['image_all'] = $this->images_model->get_images_other($id);
        }

        if($this->input->post("Upload")){


            $this->images_model->do_upload($id);
            redirect(base_url().'admin/product/update/'.$id);


        }
        if($this->input->post('update') != NULL){
            $name= $this->input->post('txt_name');
            $price= $this->input->post('txt_price');
            $sale= $this->input->post('txt_sale');
            $brand= $this->input->post('Brand');
            $desc = $this->input->post('txt_desc');
            $images= $this->input->post('img_box');
            $country = $this->input->post('countries');
            if($images == NULL || $images == 0){

                $data_product = array(
                    'product_name' => $name,
                    'product_desc' => $desc,
                    'product_price' => $price,
                    'product_sale' => $sale,
                    'brand_id' => $brand,
                    'country_id' => $country,
                    'product_mainImageId' => NULL
                );
            }else{
                $images= $this->input->post('img_box');
                $data_product = array(
                    'product_name' => $name,
                    'product_desc' => $desc,
                    'product_price' => $price,
                    'product_sale' => $sale,
                    'brand_id' => $brand,
                    'country_id' => $country,
                    'product_mainImageId' => $images
                );
            }


            $category_id = $this->input->post('checkbox');
            foreach($category_id as $categoryid){
                $category[] = array(
                    'category_id' => $categoryid,
                    'product_id' => $id);
            }
            $this->product_model->delete_re($id);
            foreach($category as $value){
                $this->product_model->update_category_product($value);
            }
            $this->product_model->update($data_product,$id);

            echo "<script>alert('bạn đã update thành công')</script>";
            redirect(base_url().'admin/product/update/'.$id);

        }else{

        }
        $this->layout->view("product/product_update", $data);

    }

    public function delete_images(){
        $image_id = $this->uri->segment(4);
        $data['images'] = $this->images_model->getMainImages($image_id);

        foreach($data['images'] as $value);
        $name = $value['image_path'];
        $product_id = $value['product_id'];
        $this->images_model->del_image($name,$product_id);
        $this->images_model->del_id($image_id);
        redirect(base_url().'admin/product/update/'.$product_id);
    }
    public function setSlider(){
        $slider = $_POST['slider'];
        if ($slider['img_order'] == "add"){
            $max = $this->slider_model->get_max_slider();
            $add_slider = array(
                "pro_id" => $slider['pro_id'],
                "img_link" => $slider['img_link'],
                "img_order" => $max[0]['img_order'] +1
            );
            $this->slider_model->add_slider($add_slider);
        }
        else {
            $this->slider_model->delete_slider($slider['pro_id']);
        }
    }
    public function total($search)
    {
        $product_search_fields = array ('product_name', 'product_desc', 'product_price');
        $total_record = $this->product_model->total_records($product_search_fields,$search);
        echo $total_record;
    }

}