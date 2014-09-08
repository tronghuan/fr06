<?php

class BaseHomeController extends MY_Controller
{
	protected $layout;
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('layout_home');
        $this->layout = new layout($layouts = array('layouts/header','layouts/wrap_center','layouts/rightSideBar','layouts/footer'));
        $this->layout->add_view_data('disable_links', 'detail');
        $this->layout->add_view_data('ajax_pagination', 0);
    }
}