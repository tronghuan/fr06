<?php

class Product extends BaseHomeController {

    public static $category_model;
    public static $_searchName;
    public static $_searchType;
    public static $_categories;
    public static $_brands;
    public static $_condition_filter;
    protected $_product_id = 0;

    public function __construct() {
        parent::__construct();

        $this->load->model('product_model');
        $this->load->model('images_model');
        $this->load->library('pagination');
        $this->load->model('config_model');
        $this->load->model('category_model');
        $this->load->model('comment_model');
        $this->load->library('rating');
        $this->load->library('my_paginationer');
        //ob_start();
        $this->load->helper(array('form', 'url'));        
    }

    public static function build_list() {
        self::$category_model = new Category_model();
        $cats = self::$category_model->gets();
        $ids = array();
        foreach ($cats as $c) {
            $cat_parent_id = $c['category_parentId'] != NULL ? $c['category_parentId'] : 0;
            $data['cats'][] = new categories($c['category_id'], $c['category_name'], $c['category_parentId']);
            if (!isset($ids[$cat_parent_id])) {
                $ids[$cat_parent_id] = array();
                $ids[$cat_parent_id][$c['category_id']] = $c['category_id'];
            } else {
                $ids[$cat_parent_id][$c['category_id']] = $c['category_id'];
            }
        }
        $level = 2;
        while (true) {
            $break = true;
            $keys = array_keys($ids);
            $n = count($ids);
            $break = true;
            for ($i = 0; $i < $n; $i ++) {
                $add = $ids[$keys[$i]];
                $ret = false;
                $ids = self::edit_at_level($ids, $add, $level, $keys[$i], $ret);
                if ($ret) {
                    unset($ids[$keys[$i]]);
                    $break = false;
                }
            }
            if ($break)
                break;
            $level ++;
        }
        $data['ids'] = $ids;
        $level = 0;
        $id_list = array('NULL');
        $cats = &$data['cats'];
        while (true) {
            $break = true;
            $cat_parent_ids = self::$category_model->get_from_parent($id_list);
            $id_list = array();
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
            if ($break)
                break;
        }
        $n = count($cats);
        for ($i = 0; $i < $n; $i ++) {
            for ($j = $i + 1; $j < $n; $j ++) {
                if ($cats[$j]->getLevel() < $cats[$i]->getLevel()) {
                    $temp = $cats[$i];
                    $cats[$i] = $cats[$j];
                    $cats[$j] = $temp;
                }
            }
        }
        for ($i = 0; $i < $n; $i ++) {
            $childs = self::$category_model->get_from_parent(array($cats[$i]->getID()));
            $childs_object = array();
            for ($j = $i + 1; $j < $n; $j ++) {
                if (in_array($cats[$j]->getID(), $childs)) {
                    $childs_object[] = $cats[$j];
                    unset($cats[$j]);
                }
            }
            array_splice($cats, $i + 1, 0, $childs_object);
        }
        return $cats;
    }

    public static function edit_at_level($array, $var, $level, $key, &$ret) {
        $temp = array();
        $result = &$array;
        while ($level -- != 0) {
            $keys = array_keys($result);
            $n = count($keys);
            for ($i = 0; $i < $n; $i ++) {
                if (is_array($result[$keys[$i]])) {
                    foreach ($result[$keys[$i]] as $k => $v) {
                        $temp[$k] = &$result[$keys[$i]][$k];
                        if ($level == 1 && $k == $key) {
                            $temp[$k] = $var;
                            $ret = true;
                        }
                    }
                } else {
                    //echo 'stupid';
                }
            }
            $result = &$temp;
        }
        return $array;
    }

    public function index($categories = '', $product_id = 0, $product_name = '', $per_page = 0, $order = 'ASC', $title = 'product_name', $limit = '', $ajax = false, $search = '') {
        /* prepare data */		
        if ($product_id != 0) {			
            redirect(base_url("home/product/detail/" . $product_id . '/' . str_ireplace(' ', '-',$product_name)));
        }
        $this->session->set_flashdata('ajax_categories', $categories);
        $ajax = $this->input->post('ajax');
        if ($ajax == false)
            $ajax = $this->input->get('ajax');
		$action = $this->input->post('action');
        if ($ajax) {
            if ($categories == '') {
                $categories = $this->session->flashdata('ajax_categories');
                $this->session->keep_flashdata('ajax_categories');
            }
            $this->session->set_flashdata('ajax', true);
        }
		if ($ajax == false || $action == 'ajax_pagination'){
            $prev_ajax = $this->session->flashdata('ajax');
            $prev_categories = $this->session->flashdata('ajax_categories');            
            if (($prev_ajax && $prev_categories == $categories) || $action == 'ajax_pagination') {
                $title = $this->session->flashdata('product_home_search_name') ? $this->session->flashdata('product_home_search_name') : $title;
                $order = $this->session->flashdata('product_home_search_type') ? $this->session->flashdata('product_home_search_type') : $order;
                //$categories = $this->session->flashdata('ajax_categories');
                $this->session->keep_flashdata('product_home_search_name');
                $this->session->keep_flashdata('product_home_search_type');
                $this->session->keep_flashdata('ajax');
            }
        }
        $this->category($categories);
        $this->order($title, $order);
        $title = self::$_searchName;
        $order = self::$_searchType;
        $cats = $this->session->userdata('categories');
        $cat_ids = array();
        foreach ($cats as $c) {
            $cat_ids[] = $c->getID();
        }
        // if search and filter move offset to 0
        $data['title'] = "List all product";
        $total_product = $this->product_model->total_records('', '', $cat_ids);
        $number_per_page = $this->config_model->number_per_page();
        $per_page = 4;
        foreach ($number_per_page as $key => $value) {
            $per_page = $value['config_value'];
        }
        // Get start 
        if (isset($_REQUEST['per_page'])) {
            if ($_REQUEST['per_page'] != NULL) {
                $offset = $_REQUEST['per_page'];
            } else {
                $offset = 0;
            }
        } else {
            $offset = 0;
        };
        // make a better choice for sort but need to optimization for search and filter
		if (isset($action) && $action == 'ajax_pagination') {
			if ($this->input->post('pos_offset') != false) {
				$offset = ($this->input->post('pos_offset') - 1) * $per_page;
				$this->session->set_flashdata('offset', $offset);
			//	$result['lala'] = $offset;
			}
		}
        if (!$ajax) {
            $this->session->set_flashdata('offset', $offset);
        }else if ($action != 'ajax_pagination'){
            if ($this->session->flashdata('offset') !== false) {
                $offset = $this->session->flashdata('offset');
            }
            $this->session->keep_flashdata('offset');
        }
		// --- My paginationer  --------------
		$this->my_paginationer->set_total_number($total_product);
		$this->my_paginationer->set_per_page($per_page);
		$this->my_paginationer->set_query_string('?per_page=');
		
        if ($categories != '') {
			$this->my_paginationer->set_base_url(base_url() . 'home/product/index/'. $categories );
        } else {
			$this->my_paginationer->set_base_url(base_url() . 'home/product/index');
        }

        //$pagination = $this->pagination->create_links(); # Tạo link phân trang
		$pagination = $this->my_paginationer->page_links($offset);
        // get data per_page
        $data_get['new_product'] = $this->product_model->list_products($per_page, $offset, $order, $title, '', array(), $cat_ids);
		
		//pagination
        $data['pagination'] = $pagination;
		
		
        foreach ($data_get['new_product'] as $product) {
            // img src pre_pare
            if ($product['product_mainImageId'] != null) {
                $src = $this->images_model->get_images($product['product_id'], $product['product_mainImageId']);
            } else {
                $src = 0;
            }
            if ($src != 0) {
                $src_s = '<img class="thumbnail" width="150px" height="150px" src="' . $src[0]['url'] . '" alt= />';
            } else {
                $src_s = '<img width="150px" height="150px" src="' . base_url('public/home/assets/img/no-image.png') . '" >';
            }
            if ($product['product_sale'] == 0 || $product['product_sale'] == Null) {
                
            } else {
                $data['new_price'] = $product['product_price'] - $product['product_sale'];
            }
            // make new product            
            $data['new_product'][] = array(
                "product_id" => $product['product_id'],
                "product_name" => $product['product_name'],
                "product_price" => $product['product_price'],
                "product_mainImageId" => $src_s,
                "product_id" => $product['product_id'],
                "sale_price" => number_format($product['sale_price']),
            );
        };
        //make pager
        $data['nums'] = $total_product;
        $data['ajax_pagination'] = 1;
        //load view
        if ($ajax || $action == 'ajax_pagination') {
            $result ['product'] = $data['new_product'];
            $result ['links'] = $pagination;
            $result ['cat'] = $cats;
            $result ['per_page'] = $offset;
            echo json_encode($result);
        } else{
            $this->layout->view('product/list_product', $data);                    
        }
    }

    public function category($categories = '') {
        $cats = $this->build_list();
        $cates = array();
        $level = -1;
        foreach ($cats as $key => $c) {
            $var_1 = strtolower($c->getName());
            $var_2 = strtolower($categories);
            //$var_2 = mbstrreplace()
            if (strcasecmp($var_1, $var_2) == 0) {
                $level = $c->getLevel();
                $cates[] = $c;
            } else {
                if ($c->getLevel() <= $level)
                    break;
                if (!empty($cates))
                    $cates [] = $c;
            }
        }
        $this->session->set_userdata('categories', $cates);
    }

    public function test() {
        $search_fields = array('product_name', 'product_price', 'product_desc');
        $search = '';
        $order_by = 'ASC';
        $title = 'product_date'; // product_price
        $cat_array = array('14', '6', '5');
        $brands = array();
        $other_where = array(
            '(product_price * (100 - product_sale))/100 > 0',
            '(product_price *  (100 - product_sale))/100 < 1010101'
        );
        $start = 0;
        $limit = 20;
        $products = $this->product_model->list_products($limit, $start, $order_by, $title, 'Iphone', $search_fields, $cat_array, $brands, $other_where);
    }

    public function detail($product_id, $producct_name = '', $post_review = false, $review_text = '', $review_rate = 0) {
        $data = array();

        $data['captcha'] = $this->get_captcha();
        if ($product_id == '')
            $product_id = $this->uri->segment(4);
        if ($product_id == '' && isset($_REQUEST['product_id'])) {
            $product_id = $_REQUEST['product_id'];
        }
        if ($product_id != '') {
            $product_info = $this->product_model->gets($product_id);
            $comments = $this->comment_model->gets($product_id);
            $images = $this->images_model->getAllImages($product_id);

            $src = array();
            $images['main'] = '<img width="auto" height="auto" src="' . base_url('public/home/assets/img/no-image.png') . '" >';
            $data['imgs'] = $images;
            $data['product'] = $product_info;
            $data['comments'] = $comments;
            $rating = $this->get_rating($product_id);
            $data['rating'] = $rating;
        }
        $this->layout->view('product/product_detail', $data);
    }

    public function rating() {
        $captcha = $this->input->post('captcha');
        $result = array(
            'status' => 1,
        );
        if (strtolower($captcha) != strtolower($this->session->userdata('captcha'))) {
            $result['status'] = 0;
            echo json_encode($result);
        } else {
            $comment = array(
                'comment_content' => $this->input->post('review'),
                'comment_name' => $this->input->post('name'),
                'comment_email' => $this->input->post('email'),
                'comment_rate' => $this->input->post('rated'),
                'comment_title' => $this->input->post('title'),
                'product_id' => $this->input->post('product_id'),
                'comment_date' => time(),
            );
            $comment_id = $this->comment_model->insert_comment($comment);
            $result = $this->get_rating($comment['product_id']);
            $result['status'] = 1;
            $result['comment_id'] = $comment_id;

            $rating = new Rating($comment['comment_rate']);
            $result['rate'] = $rating->create_rate($comment['comment_rate']);
            echo json_encode($result);
        }
    }

    public function get_captcha($ajax = false) {
        $ajax = $this->input->post('ajax');
        $this->load->helper('captcha');
        $vals = array(
            'img_path' => 'captcha/',
            'img_url' => base_url() . 'captcha/',
            'img_width' => 150,
            'img_height' => 30
        );
        $cap = create_captcha($vals);
        $this->session->set_userdata('captcha', $cap['word']);
        if ($ajax)
            echo json_encode($cap['image']);
        else
            return $cap['image'];
    }

    public function get_rating($product_id, $ajax = FALSE) {
        $totalComments = $this->comment_model->total_comments($product_id);
        if (!empty($totalComments) && $totalComments['total_num'] > 0)
            $k = $totalComments['total_rate'] / $totalComments['total_num'];
        else
            $k = 0;
        $rating = new Rating($k);
        $result['product'] = $rating->create_rate($k, 'product_rate', 'filled');
        $result['customer'] = $rating->create_rate($k, 'customer_rate');
        $result['total'] = isset($totalComments['total_rate']) ? $totalComments['total_rate'] : 0;
        $result['nums'] = isset($totalComments['total_num']) ? $totalComments['total_num'] : 0;
        $ajax = $this->input->post('ajax');
        if ($ajax === TRUE) {
            echo json_encode($result);
        } else
            return $result;
    }

    public function link_thich($id, $ajax = false) {
        if ($ajax == false) {
            $ajax = $this->input->post('ajax');
        }
        $break = true;
        $likes = $this->session->userdata('likes');
        if ($likes != false) {
            foreach ($likes as $key => $like_id) {
                if ($id == $like_id) {
                    $number = $this->comment_model->dis_like($id);
                    $break = false;
                    unset($likes[$key]);
                    break;
                }
            }
        }
        if ($break)
            $number = $this->comment_model->like($id);
        if ($likes == false)
            $likes = array();
        if ($break)
            $likes[] = $id;
        $this->session->set_userdata('likes', $likes);
        if ($ajax) {
            $result = array(
                'status' => 1,
                'number' => $number,
            );
            echo json_encode($result);
        }
        return $number;
    }

    public function test_l($id = 42, $ajax = false) {
        echo 'test_link_thich';
        $this->comment_model->like($id);
    }

    public function search($search_name = '') {
        if ($search_name == '') {
            $search_name = $this->input->post('search');
        }
        $search_fields = array('product.product_name', 'category.category_name', 'brand.brand_name', 'product.product_desc');
        $list_products = $this->product_model->search($search_fields, $search_name, true);
        $result[] = '<div class="result" style="margin-left: -15px;"><ul class="list-group">';
        foreach ($list_products as $row) {
            $product_name = $row['product_name'];
            //$product_date = date('d-m-Y', $row['product_date']);
            $product_desc = $row['product_desc'];
            $product_desc = substr(strip_tags($product_desc), 0, 27);
            $category_name = $row['category_name'];
            $brand_name = $row['brand_name'];
            $b_proName = '<b>' . $search_name . '</b>';
            $b_proDesc = '<b>' . $search_name . '</b>';
            $b_catName = '<b>' . $search_name . '</b>';
            $b_brandName = '<b>' . $search_name . '</b>';
            $final_proName = str_ireplace($search_name, $b_proName, $product_name);
            $final_proDesc = str_ireplace($search_name, $b_proDesc, $product_desc);
            $final_catName = str_ireplace($search_name, $b_catName, $category_name);
            $final_brandName = str_ireplace($search_name, $b_brandName, $brand_name);

            $var = '<li class="list-group-item">';
            $var .= '<a href="' . base_url('home/product/detail/' . $row['product_id'] . '/' . $row['product_name']) . '" style="widht:100%; height: 100%">';
            $var .= '<div class="name" style="display: inline-block; padding: 10px;text-align: right;">';
            $var .= $final_proName;
            $var .= '</span>&nbsp;<br/>';
            $var .= $final_proDesc . '-' . $final_catName . '-' . $final_brandName;
            $var .= '<br/>';
            $var .= '</div>';
            $var .= '<div class="img" style="display: inline-block;"><img src="images/kenshin.jpg" style="width: 50px; height: 50px;" /></div>';
            $var .= '</a>';
            $var .= '</li>';
            $result[] = $var;
        }
        $result[] = '</ul></div>';
        echo json_encode($result);
    }

    public function test_s($s) {
        $this->search($s);
    }

    public function result($search_name = '') {
        if ($search_name == '') {
            $search_name = $this->input->get('search_name');
        }
        $search_fields = array('product.product_name', 'category.category_name', 'brand.brand_name', 'product.product_desc');
        $list_products = $this->product_model->search($search_fields, $search_name, true);
        $data['list_products'] = $list_products;
        $this->layout->view('product/search_result', $data);
    }

    public function order($title = 'product_name', $order = 'ASC') {
        if (isset($_POST['btn_order'])) {
            $title = $this->input->post('order_name');
            $order = $this->input->post('order_type');
            $this->session->set_flashdata('product_home_search_name', $title);
            $this->session->set_flashdata('product_home_search_type', $order);
        } else {
            if ($this->session->flashdata('product_home_search_name') != FALSE) {
                $title = $this->session->flashdata('product_home_search_name');
            }
            if ($this->session->flashdata('product_home_search_type') != FALSE) {
                $order = $this->session->flashdata('product_home_search_type');
            }
        }
        self::$_searchName = $title;
        self::$_searchType = $order;
    }
    public function test_ajax() {
        
    }

}
