<?php if ( ! defined('BASEPATH')) exit('No direct script  when access allowed'); ?>

<?php

class Layout
{
    private $CI;
    private $title_for_layout = NULL;
    private $title_separator = '|';
    private $file_includes = array();
    protected $layouts = array();
    private $includes = array();
    protected $view_data = array();
    public function __construct($layouts = array())
    {
        $this->CI =&get_instance();
        if (is_array($layouts) && ! empty($layouts)) {
            foreach ($layouts as $value) {
                $this->layouts[] = $value;
            }
        }else
            $this->layouts = array('layouts/header','layouts/leftSideBar', 'layouts/rightSideBar','layouts/footer');
    }
    /**
     * Load header and footer for view
     * @param	the main view name	$view_name	string
     * @param	array	$params		variables
     * @param	string	$layout		default file : header , footer , left
     */
    public function view($view_name, $params = array(), $layout = 'default')
    {
        if ($this->title_for_layout != NULL)
        {
            $separated_title_for_layout = $this->title_separator . $this->title_for_layout;
        }
        if (! empty($this->view_data)) {
            foreach($this->view_data as $key => $data_view) {
                $data[$key] = $data_view;
            }
        }
        // load the view content, with the params passed
        if (is_array($view_name)) {
            $view_content = '';
            foreach ($view_name as $view){
                $view_content .= $this->CI->load->view($view);
            }
        }else
            $view_content = $this->CI->load->view($view_name, $params, TRUE);
        // prepare title or title default
        $data['title_for_layout'] = isset($params['page_title'])?$params['page_title'] : config_item('site_name');

        // make layout
        if ($layout == 'default') {
            $data['content_for_layout'] = $view_content;
            //$data['title_for_layout'] = $separated_title_for_layout;
            if(isset($params['success'])) $data['success'] = $params['success'];
            if(isset($params['errors'])) $data['errors'] = $params['errors'];
            if(isset($params['message'])) $data['message'] = $params['message'];
            if(isset($params['alert'])) $data['alert'] = $params['alert'];
            if(isset($params['info'])) $data['info'] = $params['info'];
            //=============================================================================
            //=============================================================================
            //=============================================================================
            $i = 0;
            foreach ($this->layouts as $key => $value) {
                # code...
                if ($i == 0)$this->CI->load->view($value,$data);
                else $this->CI->load->view($value);
                $i ++;
            }
            //=============================================================================
            //=============================================================================
            //=============================================================================
        }else {
            $this->CI->load->view('layouts/' . $layout , array(
                'title_for_layout' => $params['page_title'],
                'content_for_layout' => $view_content,
            ));
        }
    }
    public function set_title($title)
    {
        $this->title_for_layout = $title;
    }
    /**
     * Add file extend
     * @param	string	$path				path to file 'assets/css/'
     * @param	string	$preend_base_url	absolute or relative
     */
    public function add_include($path, $preend_base_url = TRUE)
    {
        if ($preend_base_url)
        {
            $this->CI->load->helper('url');
            $this->file_includes[] = base_url() . $path;
        } else {
            $this->file_includes[] = $path;
        }
    }

    public function print_includes()
    {
        // Initalize string that will hold all includes     // Initialize a s
        $final_includes = '';
        foreach ($this->file_includes as $include)
        {
            $include .= base_url() . $include;
            if (@preg_match ('/js$', $include))
            {
                // its a JS file
                $final_includes .= '<script type="text/javascript" src="'. $include .'"></script>';
            }else if (@preg_match('/css$/', $include))
            {
                // It's a CSS file
                $final_includes .= '<link href="'. $include . '" rel="stylesheet" type="text/css" />';
            }
        }
        return $final_includes;
    }
    public function add_view_data($key, $data)
    {
        if (isset($this->view_data[$key])) {
            $coltech = $this->view_data[$key];
            $coltech .= ',' . $data;
        }else $this->view_data[$key] = $data;
    }
}