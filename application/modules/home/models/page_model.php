<?php

class Page_model extends MY_Model
{
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('page_model');
  }
}