<?php
    class Brand extends BaseAdminController{
        public function __construct(){
            parent::__construct();
            $this->load->model('brand_model');
            $this->load->library('layout');
        }
        public function index(){
    		$this->load->library('pagination');
            $config['base_url'] = base_url() . 'admin/brand/index?id=';
    		$config['total_rows'] = $this->brand_model->total();
    		$config['per_page'] = 2; 
            $data['padding'] = isset($_GET['padding']) ? $_GET['padding'] : '1';
    		$data['total_page'] = ceil($config['total_rows']/$config['per_page']);
    		$this->pagination->initialize($config); 
    		$start = ($data['padding'] - 1 ) * $config['per_page'];
    		$data['listBrands'] = $this->brand_model->listbran($config['per_page'],$start);
                $data['page_title'] = 'Danh sách hãng';
    		$this->load->library('layout');
                $this->layout->view('brand/listBrands', $data);
        }
        public function edit($id)
        {            
            $id = $this->uri->segment(4);
            $data['single_brand'] = $this->brand_model->getOnce($id);
            $data['page_title'] = 'Cập nhập brand';
            if($this->input->post('submit') !== FALSE){
                $name = $this->input->post('txt_name');
                $desc = $this->input->post('txt_desc');
                $data = array(
                    'brand_name' => $name,
                    'brand_desc' => $desc
                );
                $this->brand_model->update($id,$data);
                redirect(base_url().'admin/brand/index');
            }            
            $this->layout->view('brand/update', $data);
        }
		
     public function search(){
        $brands = $this->brand_model->get_all_brand();
        $result = array();
        if ($this->input->post("submit")){
            $keywords = $this->input->post("search");
            $type = $this->input->post("type");

            if (!empty($keywords) || $keywords!=""){
                if ($type == 1) {
                    foreach ($brands as $brand){
                        if (preg_match("/$keywords/i",$brand['brand_name'])){
                            $result['brand'][] = $brand;
                        }
                        else $result['not_found'] = "No result found";
                    }
                }
                else if ($type == 0){
                    foreach ($brands as $brand){
                        if (preg_match("/\b$keywords\b/i",$brand['brand_id'])){
                            $result['brand'][] = $brand;
                        }
                        $result['not_found'] = "No result found";
                    }
                }
            }
            else {
                $result['no_query'] = "Enter a keyword to search";
            }
        }
        // echo "<pre>"; print_r($result);die();
        $this->layout->view('brand/search_brand', $result);
    }
		    public function show_brand_id() {
        $id = $this->uri->segment(4);
        $data['single_brand'] = $this->brand_model->getOnce($id);
        $this->load->view('update', $data);
    }
				public function delete(){
		
				}
				public function update(){
						$id = $this->uri->segment(4);
						if($this->input->post('submit') != NULL){
								$name = $this->input->post('txt_name');
								$desc = $this->input->post('txt_desc');
								$data = array(
										'brand_name' => $name,
										'brand_desc' => $desc
								);
								$this->brand_model->update($id,$data);
								redirect(base_url()."admin/brand/listbrand");
						}
				}
				
				public function insert ()
				{
						$data['action'] = 'insert';
						$this->layout->view('brand/update');
						
				}
		}
?>
