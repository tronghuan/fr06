<?php

class my_paginationer {
    
    protected $_base_url;
    public $_next = '>';
    public $_prev = '<';
    public $_open_wrap = '<li>';
    public $_close_wrap = '</li>';
    protected $_number_per_page = '7';
    protected $_total_number;
	protected $_query_string = '/';
    public function __construct()
    {
    }
    public function set_per_page($nums)
    {
        if ($nums > 0) {
            $this->_number_per_page = $nums;
        }else {
            $this->_number_per_page = 7;
        }
    }
    public function set_total_number($nums)
    {
        if ($nums > 0) {
            $this->_total_number = $nums;
        }     
    }
    function set_base_url($base_url)
    {
        if ($base_url) {
            $this->_base_url = $base_url;
            return $base_url;
        }else return false;        
    }
    function page_links($id = '')
    {
        
        $nums =  ($this->_total_number / $this->_number_per_page) ;
        if ($nums <= 0 || $this->_total_number <= $this->_number_per_page) return '';
        if (is_float($nums)) $nums + 1;
        $prev = '';
        $next = '';
        if ($id) {
            $condi = $id - $this->_number_per_page;
            if ($condi >= 0)
                $condi = (int) ($id / $this->_number_per_page) -  1;
                $prev = '<li class="lt">';$prev .= '<a href="'. $this->_base_url.$this->_query_string.$condi * $this->_number_per_page.'">'.$this->_prev.'</a>';$prev .= '<li>';
            
            $next_condi = ($id + $this->_number_per_page) < $this->_total_number;
            if ($next_condi ) {
                $condi = (int) ($id / $this->_number_per_page) + 1;
                $next = '<li class="gt">';$next .= '<a href="'. $this->_base_url.$this->_query_string.$condi * $this->_number_per_page.'">'.$this->_next.'</a>';$next .= '</li>';
            }
        }
        $pages = '';
        $pages .= $prev;
        $i =  0;
        $i_ =  (int)($id / $this->_number_per_page) ;
        for(; $i < $nums  ;  $i ++) {
            if ($i  !== $i_)
                $pages .= '<li><a href="'. $this->_base_url.$this->_query_string.$i * $this->_number_per_page.'">'.($i + 1).'</a>&nbsp;</li>';
            else $pages .= '<li class="active" ><a href="">'.($i_ + 1). '&nbsp;</a></li>'; 
        }
        $pages .= $next;
        return $pages;
    }
    public function wrap($pages)
    {
	    foreach ($pages as $key => $page){
		    $tmp = $this->_open_wrap;
		    $tmp .= $page;
		    $tmp .= $this->_close_wrap;
		    $pages[$key] = $tmp; 
	    }
	    return $pages;
    }
	public function set_query_string($query)
	{
		$this->_query_string = $query;
	}
}
?>
