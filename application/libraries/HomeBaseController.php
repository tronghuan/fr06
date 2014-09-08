<?php
/**
 * All default controller have to extends this controller
 */
session_start ();
class HomeBaseController extends MX_controller {
    public function __construct() {
        parent::__construct ();
        $this->load->model ( "menu_model" );
        $this->load->model ( "cate_model" );
    } // end __construct
    public function loadView($url, $data = array()) {
        $this->load->library ( 'cart' );
        $data ['total'] = $this->cart->total_items ();
        $data ['money'] = $this->cart->total();
        $cate = array();
        $cate = $this->getCategory();
        $cate_count = $this->menu_model->count_product();
        foreach($cate as $key=>&$value)
        {
            $cate_id = $value['cate_id'];
            if(array_key_exists($cate_id,$cate_count))
            {
                $value['count'] = $cate_count[$cate_id];
            }
            else
            {
                $value['count'] = 0;
            }
        }
        $this->recount($cate, 0);
        $data['html'] = $this->createMenu($cate);
        $this->load->view ( $url, $data );
    }
    public function createMenu($listArr = array(), $parent = 0, $level = 0) {
        $html = '';
        if ($listArr == '')
            return '';
        $have_child = false;
        $html .= ($level == 0 ? "<div id='menu'>" : "");

        foreach ( $listArr as $value ) {
            if ($value ['cate_parent'] == $parent) {
                $have_child = true;
                break;
            }
        }
        if ($have_child)
            $html .= "<ul>";
        $cate_count = $this->menu_model->count_product ();
// 		echo "<pre>";
// 		print_r($cate_count);die();
        foreach ( $listArr as $key => $value ) {
            if ($value ['cate_parent'] == $parent) {
                $html .= "<li><a href='#'>" . $value ['cate_name'] . "(" . $value ['count'] . ")" . "</a>";
                unset ( $listArr [$key] );
                $html .= $this->createMenu ( $listArr, $value ['cate_id'], $level + 1 );
                $html .= "</li>";
            }
        }
        if ($have_child)
            $html .= "</ul>";
        $html .= $level == 0 ? "</div>" : "";
        return $html;
    }
    private function recount(& $list, $parent_id = 0) {
        foreach ( $list as &$child ){

// 			print_r($list);die();
            if ($child ['cate_parent'] == $parent_id) {
                $this->recount ( $list, $child ['cate_id'] );
                foreach ( $list as &$parent ) {
                    if ($parent ['cate_id'] == $parent_id) {
                        $parent ['count'] += $child ['count'];
                        break;
                    }
                }
            }
        }
    }
    public function getCategory($LevelSign = "") {
        $SequenceList = $this->cate_model->getAll ();
        if (empty ( $SequenceList )) {
            echo "Have no category!";
        } else {
            // get Category level 0, ParentId = 0;
            $strLevel = "";
            $SortedList = $this->recursive ( 0, $SequenceList, $strLevel );
            return $SortedList;
        } // end if empty
    } // end getCategory
    private function recursive($ParentId, &$List, $strLevel) {
        if (! empty ( $List )) {
            if ($ParentId != 0) {
                $strLevel .= "";
            } else {
                // $strLevel = "";
            }

            $LevelList = array ();

            foreach ( $List as $key => $CateDetail ) {
                if ($ParentId == $CateDetail ['cate_parent']) {
                    $temp = array (
                        'cate_id' => $CateDetail ['cate_id'],
                        'cate_name' => $strLevel . $CateDetail ['cate_name'],
                        'cate_parent' => $CateDetail ['cate_parent'],
                        'cate_order' => $CateDetail ['cate_order']
                    );
                    $LevelList [$key] = $temp;
                    // $LevelList[$key] = $CateDetail;
                    unset ( $List [$key] );
                } // end if ParentId
            } // end foreach $List

            if (! empty ( $LevelList )) {
                $LevelSortByOrder = array ();
                foreach ( $LevelList as $key => $LevelCateDetail ) {
                    $LevelKeyOrder [$key] = $LevelCateDetail ['cate_order'];
                }

                asort ( $LevelKeyOrder );

                $LevelSorted = array ();
                foreach ( $LevelKeyOrder as $key => $CateOrder ) {
                    $LevelSorted [$key] = $LevelList [$key];
                }

                $LevelAndSub = array ();
                foreach ( $LevelSorted as $key => $LevelCateDetail ) {
                    $LevelAndSub [] = $LevelCateDetail;
                    $SubLevel = $this->recursive ( $LevelCateDetail ['cate_id'], $List, $strLevel );
                    if (! empty ( $SubLevel )) {
                        foreach ( $SubLevel as $key => $SubLevelCateDetail ) {
                            $LevelAndSub [] = $SubLevelCateDetail;
                        }
                    } // end if SubLevel
                } // end foreach LevelSorted
                return $LevelAndSub;
            } // end if empty $Level
        } // end if ! empty()
    } // end recursive()
} // end class AdminBaseControllerSltZZz