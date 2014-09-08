<?php
class home extends BaseAdminController{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $data = array();
        $this->layout->view('home/home');
    }
}