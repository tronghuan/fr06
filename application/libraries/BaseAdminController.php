<?php
/**
 * class must extends for every admin's controller
 * targer: - secure with force signin
 * - create session
 * - using hash for login
 */
session_start();
class BaseAdminController extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        
        $action = $this->uri->segment(3);
        if( ! isset($_SESSION['user']) && $action != "login"){
            redirect(base_url("admin/user/login"));
        }
        $this->load->library('layout');
    }
}