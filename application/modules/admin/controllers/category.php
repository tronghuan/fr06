<?php

class Category extends BaseAdminController{
    public static $category_model ;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        //$this->load->library('category');
        $this->load->library('form_validation');
    }
    public function index(){

        $this->data['cats'] = $this->build_list();
        $this->layout->view('category/index_category', $this->data);

    }
    public function add()
    {
        $this->load->library('layout');

        $btnok = $this->input->post('btnok');
        if ($btnok !== FALSE) {
            $name = $this->input->post('category_name');
            $parentID = $this->input->post('category_parentID');
            $this->form_validation->set_rules('category_name', 'Category name', 'required|trim|xss_clean');
            $this->form_validation->set_message('category_name', 'The %s field can not be empty');
            $check = $this->category_model->find($name);
            $check = $check == FALSE ? true : false;
            if ($this->form_validation->run() && $check) {
                $this->category_model->insert_category(array('category_name' => $name, 'category_parentid'=> $parentID ));
                $data['success'] = 'Insert thanh cong';
            }else {
                if (! $check)$data['errors'][] = 'Category đã tồn tại';
                $data['errors'][] =  validation_errors();
            }
        }

        $data['page_title'] = 'Thêm Category';
        $data['cats'] = $this->build_list();

        $this->layout->view('category/insertCategory', $data);
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

    public function test(){
        $a = array (
            '1' => array (
                '2' => '2',
                '5' => '5',
                '4' => array(
                    '9' => '9',
                    '4' => array(
                      'a' => 'b',
                    ),
                )
            ),
            '6' => array ('7' => '7'),
        );
        $ret = false;
        $result = $this->edit_at_level($a, array('8' => '8','b' => 'b'), 4 ,'a', $ret);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
    public function indexs(){
        $sql = $this->category_model->fetch_all();
        foreach($sql->result_array() as $row){
            $data[]=$row;
        }

        foreach($sql->result_array() as $row){
            if( $row['category_parentId'] == null){
                $this->result[] = $row;
                $this->dequy($row,$data);
            }
        }
        $data=array();
        $a = count($this->result);
        for( $i=0 ; $i<$a ; $i++ ){
            $data[$this->result[$i]['category_id']]=$this->result[$i];
        }

        for( $i=1 ; $i<=$a ; $i++ ){
            if (! isset($data[$i]['category_parentId']['level']) || $data[$i]['category_parentId'] == null){ $data[$i]['level'] = 0 ;}
        }

        for( $i=1 ; $i<=$a; $i++ ){
            if( $data[$i]['category_parentId'] != null){
                $data[$i]['level'] = 0;
                $data[$i]['level'] = $data[$data[$i]['category_parentId']]['level'] +1;
            }
        }
        $d['data'] = $data;

        // load layout
        $this->load->library('layout');
        $d['page_title'] = 'Danh sách Category';
        $this->layout->view('category/list_category', $d);
    }
    public function dequy( $phantu = array(),$sql=array()){
        foreach( $sql as $key=>$row ){
            if( $row['category_parentId'] == $phantu['category_id']){
                $this->result[] = $row;
                $this->dequy($row,$sql);
            }
        }
    }
    public function test_b(){
        $cats = $this->build_list();
        echo '<pre>';
        print_r ($cats);
        echo '</pre>';
    }
}
