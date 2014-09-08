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
