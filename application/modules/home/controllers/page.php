<?php

class Page extends BaseHomeController{
  
  public function __construct()
  {
    
  }
  public function index($product = '')
  {
    $products = array();
    if ($product != ''){
      // get product informations
      $products = $this->product($product);
      
      // get product imgaes references
      $img_thumbs = array();
      
      // change to thumber if it's thumb
      
      // load to view
    }
  }
  public function product($product_name = '')
  {
    
  }
}
