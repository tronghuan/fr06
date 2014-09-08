<?php

class Report extends BaseAdminController {
  public static $_searchName;
  public static $_searchType;
  public static $category_model;
  public $itens_per_page = 7;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('order_model');
    $this->load->model('category_model');
    $this->load->library('my_paginationer');
    //self::$cateegory_model = new Category_model();
  }

  /**
   * show a list best selling product
   * show a list best selling categories
   * @return	data json if ajax call
   */
  public function index($start = 0, $order = 'ASC', $title='order_date', $limit = '' ,$change = 'product', $format = 'd-m-Y')
  {
    $now = time();
    $endDate = date($format, $now);

    $now = explode('-', $endDate);
    $now[0] = '01';
    $startDate = implode('-', $now);
    if ($this->session->flashdata('start_date') != FALSE){
      $startDate = $this->session->flashdata('start_date');
      $this->session->keep_flashdata('start_date');
    }
    if ($this->session->flashdata('end_date') != FALSE){
      $endDate = $this->session->flashdata('end_date');
      $this->session->keep_flashdata('end_date');
    }
    $this->data['end_date'] = $endDate;
    $this->data['start_date'] = $startDate;

    if ($start < 0  || ! is_numeric($start)) {
			redirect( base_url('admin/user'));
			$this->data['errors'][] = 'index không có sẵn';
		}

		$limit = $this->session->flashdata('user_limit');
		$limit = $limit ? $limit : 7 ;
    if (isset ($_POST['btnok']) || $this->session->flashdata('start_date') != FALSE ) {
      $startDate = $this->input->post('start_date') ? $this->input->post('start_date') : $startDate;
      $endDate = $this->input->post('end_date') ?  $this->input->post('end_date') :  $endDate;
      $this->session->set_flashdata('start_date', $startDate);
      $this->session->set_flashdata('end_date', $endDate);
      $status = true;
      if ($this->validate_date($startDate, $format) == FALSE) {
        $status = $data['errors']['start_date'] = 'Start date must be validate date';
      }
      if ($this->validate_date($endDate, $format) == FALSE) {
        $status = $data['errors']['end_date'] = 'End date must be validate date';
      }
      if ($status) {
        $this->data['start_date'] =$startDate;
        $this->data['end_date'] =$endDate;

        $startDate = explode('-', $startDate);
        $startDate = mktime(0,0,0, $startDate[1], $startDate[0], $startDate[2]);

        $endDate = explode('-', $endDate);        
        $endDate = mktime(23,59,59, $endDate[1], $endDate[0], $endDate[2]);
        //$this->data['orders'] = $this->order_model->get_order_product_from_to($startDate, $endDate);
        $result_a = $this->order_model->get_order_product_from_to($startDate, $endDate);
        $result_b = $this->order_model->get_product_order_from_to($startDate, $endDate, $limit, $start);
        $product_ids = array();
        foreach ($result_b as $product_id)
        {
          $product_ids[] = $product_id['product_id'];
        }
        foreach ($result_a as $key => $product) {
          if (! in_array($product['product_id'], $product_ids)) {
            unset($result_a[$key]);
          }
        }
        $this->data['orders'] = $result_a;
        $this->data['results'] = $result_b;
        foreach ($this->data['results'] as $key => $value) {
            $this->data['results'][$key]['product_date'] = date('m-d-Y',$this->data['results'][$key]['product_date']);
            $src = $this->data['results'][$key]['product_mainImageId'] != null ? $this->images_model->get_images($this->data['results'][$key]['product_id'],$this->data['results'][$key]['product_mainImageId']) : 0;
            $src = $src != 0 ?  '<img class="thumbnail" width="250px" height="150px" src="'.$src['url'].'" alt= />' : '<img width="150px" height="150px" src="'. base_url('public/home/assets/img/no-image.png') .'" >';
            $this->data['results'][$key]['product_mainImageId'] = $src;

            $product_extra_info = '<p><b>'.$this->data['results'][$key]['product_name'] . '</b></p><span>';
            foreach ($result_a as $k => $v) {
              if ($v['product_id'] == $value['product_id']) {
                $product_extra_info .= 'order: <i>' . $v['order_fullName'] . '</i>, ';
                $product_extra_info .= 'date: <b>' . date('d-m-Y',$v['order_date']) . '</b>, ';
                $product_extra_info .= 'quantity: <i>' . $v['order_quantity'] . '</i> ';
                $product_extra_info .= 'total_price: <b>' . number_format(($v['product_price'] * $v['order_quantity']),0,',', ' '). '</b>. ';
                $product_extra_info  .= '</br>';
              }
            }
            $this->data['results'][$key]['product_extra_info'] = $product_extra_info . '</span>';
        }
        // make a pagination links
        $this->my_paginationer->set_base_url(base_url() . 'admin/report/index');
        $this->my_paginationer->set_total_number($this->order_model->total_records($startDate, $endDate));
        $this->my_paginationer->set_per_page($limit);
        $links = $this->my_paginationer->page_links($start);
        $this->data['page_links'] = $links;

        // make div report tag
        $result_d = $this->order_model->get_product_category($startDate, $endDate);
        $cat_pros = array();
        $cat_pros = $this->build_list();

        foreach ($cat_pros as $k => $v){
          foreach ($result_d as $key => $value) {
            if ($value['category_id'] == $v->getID()) {
              $cat_pros[$k]->addNums($value['nums']);
            }
          }
        }
        $n = count($cat_pros);
        for ($i = 0; $i < $n ; $i ++)
        {
          $level = $cat_pros[$i]->getLevel();
          for($j = $i + 1; $j < $n ; $j ++)
          {
            if ($cat_pros[$j]->getLevel() <= $level) {
              break;
            }
            $cat_pros[$i]->addNums($cat_pros[$j]->getNums());
          }
        }
        $level = 0;
        $array_a = array();
        $array_b = array();
        $d = $s =  $m = $e = 0;
        $max = 0;
        $result_c = array();
        $len = 0;
        $n = count($cat_pros);
        $ids = array();
        $c = 1;
        while($len < $n){
          $max = 0;
          for($i = 0; $i < $n; $i ++)
          {
            $start = true;
            if($cat_pros[$i]->getLevel() == $level &&  ! in_array($cat_pros[$i]->getID() , $array_b)) {
              if ($cat_pros[$i]->getNums() >= $max ) {
                $max = $cat_pros[$i]->getNums();
                $d = $i;
                $s = count($cat_pros);
                $array_a = array();
                $array_a[] = $cat_pros[$i];
                //var_dump($i);
                //echo 'start again<hr/>';
                $start = true;
              }else{
                if ($s == $n)$s = $i;
                $start = false;
              }
              //echo $i . '+';
            }else {
                if(! empty($array_a) && $start && ! in_array($cat_pros[$i]->getID() , $array_b)) {
                  $array_a[] = $cat_pros[$i];
                }
            }
          }
          //var_dump($array_a);
          if ($c == 2)die();
          //var_dump($cat_pros);
          if (! empty($array_a)) {
            foreach($array_a as $e){
              $result_c[] = $e;
              $array_b[]=$e->getID();
            }
            //echo $level;
            //echo $d . ', ' . $s;
            //var_dump($array_b);
            //var_dump($result_c);
            $len += count($array_a);
          }
        }
        echo '___________________';
        //var_dump($result_c);
        echo '_________________';
        //$this->data['pro_cats'] = $result_d;
        $this->data['cat_pros'] = $result_c;
      }
    }
    if ($change == 'product') {

      $this->layout->view('report/index_report_products', $this->data);
    }else if($change == 'category') {
    }
  }

  /**
   * Get data best selling product
   * @return	array
   */
  public function best_selling_product($startDate = '', $endDate = '')
  {

  }
  public function best_selling_categories($startDate = '', $endDate = '')
  {
      // xu ly nhanh hon vi toan bo duoc  dung bang mysql
      // hien thi chuc nang cho phep chon lua ngay mac dinh
  }
  public function order($startDate = '', $endDate = '')
  {
      // hien thi khi nao co order den va da co bao nhieu order
  }

  public function product()
  {
    // hien thi co bao nhieu san phan duoc them vao trong 1 thang
  }
  public function message()
  {

  }
  function validate_date($date, $format = 'd-m-Y')
  {
      $d = DateTime::createFromFormat($format, $date);
      return $d && $d->format($format) == $date;
  }

  public static function build_list()
   {
       self::$category_model = new Category_model();
       $cats = self::$category_model->gets();
       $ids = array();
       foreach ($cats as $c)
       {
           $cat_parent_id = $c['category_parentId'] != NULL ? $c['category_parentId'] : 0;
           $data['cats'][] = new categories($c['category_id'], $c['category_name'], $c['category_parentId']);
           if (! isset($ids[$cat_parent_id])) {
               $ids[$cat_parent_id]  = array();
               $ids[$cat_parent_id][$c['category_id']]  = $c['category_id'];
           }else {
               $ids[$cat_parent_id][$c['category_id']] = $c['category_id'];
           }
       }
       $level = 2;
       while ( true) {
           $break = true;
           $keys = array_keys($ids);
           $n = count($ids);
           $break = true;
           for($i = 0; $i < $n ; $i ++)
           {
               $add = $ids[$keys[$i]];
               $ret = false;
               $ids = self::edit_at_level($ids, $add, $level, $keys[$i], $ret);
               if ($ret) {
                   unset($ids[$keys[$i]]);
                   $break = false;
               }
           }
           if ($break) break;
           $level ++;
       }
       $data['ids'] = $ids;
       $level = 0;
       $id_list = array ('NULL');
       $cats = &$data['cats'];
       while (true) {
           $break = true;
           $cat_parent_ids = self::$category_model->get_from_parent($id_list);
           $id_list = array ();
           $break = true;
           foreach ($cats as $c) {
               foreach ($cat_parent_ids as $c_p) {
                   if ($c_p == $c->getID()) {
                       $c->setLevel($level);
                       $id_list[] = $c->getID();
                       $break = false;
                   }
               }
           }
           $level ++;
           if ($break)break;
       }
       $n= count ($cats);
       for ($i = 0; $i < $n; $i ++){
           for ($j = $i + 1; $j < $n ; $j ++) {
               if ($cats[$j]->getLevel() < $cats[$i]->getLevel()) {
                   $temp = $cats[$i];
                   $cats[$i] = $cats[$j];
                   $cats[$j] = $temp;
               }
           }
       }
       for ($i = 0; $i < $n ; $i ++) {
           $childs = self::$category_model->get_from_parent(array ($cats[$i]->getID()));
           $childs_object = array ();
           for($j = $i + 1; $j < $n; $j ++) {
               if (in_array($cats[$j]->getID(), $childs)) {
                   $childs_object[] = $cats[$j];
                   unset($cats[$j]);
               }
           }
           array_splice($cats, $i + 1, 0,$childs_object);
       }
       return $cats;
   }
   public static function edit_at_level($array, $var,$level, $key, &$ret)
   {
       $temp = array();
       $result =  &$array;
       while($level -- != 0){
           $keys = array_keys($result);
           $n = count($keys);
           for ($i = 0; $i < $n; $i ++) {
               if (is_array($result[$keys[$i]])) {
                   foreach($result[$keys[$i]] as $k => $v) {
                       $temp[$k] =  &$result[$keys[$i]][$k] ;
                       if ($level == 1 && $k == $key) {
                           $temp[$k] = $var;
                           $ret = true;
                       }
                   }
               }else {
                   //echo 'stupid';
               }
           }
           $result = &$temp;
       }
       return $array;
   }
}