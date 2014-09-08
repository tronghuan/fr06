<?php

class MY_Controller extends CI_Controller
{
    protected $data = array();
    public function __construct()
    {
        $data['errors'] = array();
        $data['site_name'] = config_item('site_name');
        parent::__construct();
    }
}