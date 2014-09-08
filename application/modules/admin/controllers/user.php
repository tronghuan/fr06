<?php 

class User  extends  BaseAdminController 
{
	public static $_searchName ;
	public static $_searchType ;
	public function __construct()
	{
		parent::__construct();
		$listUsers = $this->load->model('user_model');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('my_paginationer');
		$this->load->library("form_validation");		
	}
	
	public function index($start = 0, $order = 'ASC', $title='user_name', $limit = '', $ajax = false, $search = '') 
	{
				/*
				 * make static vars
				 */
		$user_search_fields = array ('user_name', 'user_fullName', 'user_email');
		$search = $this->session->flashdata('searchs');
		if ($start < 0  || ! is_numeric($start)) {
			redirect( base_url('admin/user'));
			$this->data['errors'][] = 'index không có sẵn';
		}		
		if (isset($_POST['btnok'])) {
			$title = $this->input->post('search_name');
			$order = $this->input->post('type_search');
		} else {
			if ($this->session->flashdata('user_search_name') != FALSE){
				$title = $this->session->flashdata('user_search_name');
			}
			if ($this->session->flashdata('user_search_type') != FALSE){
				$order = $this->session->flashdata('user_search_type');
			}
		}
		self::$_searchName = $title;
		self::$_searchType = $order;
		$limit = $this->session->flashdata('user_limit');
		$limit = $limit ? $limit : 3 ;
		
		// change vars if ajax call
		if (isset ($_REQUEST['ajax']) && $_REQUEST['ajax']) {
			$key = isset($_REQUEST['key']) && $_REQUEST['key'] != null ? $_REQUEST['key'] : '';
			$value = isset($_REQUEST['value']) && $_REQUEST['value'] != null ? $_REQUEST['value'] : '';
			$n = count ($key);
			$remember = $limit;
			for ($i = 0 ; $i < $n; $i ++){
				$$key[$i] = $value[$i];
			}
			if ($limit > $remember)
				$start -= ($limit - $remember);
			$start = ($start >= 0) ? $start : 0;
			if ($search !==  $this->session->set_flashdata('searchs', $search)){
				$start = 0;
				$this->session->set_flashdata('searchs', $search);
			}
		}
		
		// prepare for layout
		$this->session->set_flashdata('user_limit', $limit);		
		$this->load->library('layout');
		
		// get data for layo
		$this->data['listUsers'] = $this->user_model->list_users($limit, $start, $order , $title, $search, array('user_name', 'user_email', 'user_fullName'));
		$this->data['page_title'] = 'Danh sách 	người dùng';
		$this->data['i'] = $start;	

		//prepare for pagination
		$this->my_paginationer->set_base_url(base_url() . 'admin/user/index');
		if ($search !== '')
			$this->my_paginationer->set_total_number($this->user_model->total_records(array('user_name', 'user_email','user_fullName'), $search));
		else
			$this->my_paginationer->set_total_number($this->user_model->total_records());
		$this->my_paginationer->set_per_page($limit);
		$links = $this->my_paginationer->page_links($start);
		$this->data['page_links'] = $links;
		$this->data['limit'] = $limit;
		
		// change paginaton if ajax call
		if ($ajax) {
			$ret['page_links'] = $this->data['page_links'];
			$ret['listUsers'] = $this->data['listUsers'];
			$ret['i'] = $this->data['i'];
			echo json_encode($ret); // echo json to ajax
		}else
		 // ajax not call
			$this->layout->view('user/listUsers',$this->data);
	}
	//protected function ajax_search_pages()
	public function delete(){
		$id = $this->uri->segment(4);
		$this->user_model->deleteUser($id);
		redirect(base_url()."admin/user/index");			
	}
	public function edit($id = '')
	{
		if ($id !== '') echo $id;
	}
				public function add(){
		$this->load->library('layout');
		$data['page_title'] = "Thêm người dùng";
            
            if( $this->input->post('submit') != null){
                
                if (  $this->input->post('user_name')== null ||
                     $this->input->post('full_name') == null || $this->input->post('pass')== null ||
                     $this->input->post('user_email') == null || $this->input->post('user_address')== null ||
                     $this->input->post('user_phone') == null || $this->input->post('user_level') == null ){
                    echo "<font color='red'><center> Hãy nhập đầy đủ thông tin </center></font>";
                }else{
                    $name = $this->input->post('user_name');
                    $full_name = $this->input->post('full_name');
                    $pass = $this->input->post('pass');
                    $mail = $this->input->post('user_email');
                    $address = $this->input->post('user_address');
                    $phone = $this->input->post('user_phone');
                    $level = $this->input->post('user_level');
                    $gender = $this->input->post('user_gender');
                    
                    
                    $db=array(
                        "user_name" => $name,
                        "user_fullname" => $full_name,
                        "user_password" => $pass,
                        "user_email" => $mail,
                        "user_address" => $address,
                        "user_phone" => $phone,
                        "user_level" => $level,
                        "user_gender" => $gender                    
                        );
                    $tb = $this->validate($db);
                    if ( $tb != '') echo $tb;
                    else {
												$db['user_password'] = $db['user_password'];
												$db['user_password'] = md5($db['user_password']);						
												$this->user_model->insert($db);
												$data['success'] = 'Thêm thành công.';
												}
								}
            }
								$this->layout->view('user/insert_user', $data);	    
        }	
	public function validate($data = array()){
            $result = $this->user_model->fetch_all();
            $tb = '';
            foreach ($result -> result_array() as $row){
                if( $data['user_name'] == $row['user_name']){
                return $tb = "<font color='red'><center> Tài khoản với user name đã tồn tại! </center></font>";
                }
            }
            if( strlen($data['user_password']) < 6 ){
                return $tb =  "<font color='red'><center> Mật khẩu quá ngắn! </center></font>";
            }
            $a = '/@/';
            $b = '/.com$/';
            if( !((preg_match($a,$data['user_email'])) && ( preg_match($b,$data['user_email'])))){
                return $tb ="<font color='red'><center>Email của bạn chưa đúng ! </center></font>";
            }
            else{
                foreach ($result -> result_array() as $row){
                    if( $data['user_email'] == $row['user_email']){
                    return $tb = "<font color='red'><center> Email đã được sử dụng ! </center></font>";
                }
            }
            }
            if( $data['user_phone'] < 1000000000 || $data['user_phone'] > 99999999999){
                return $tb  ="<font color='red'><center>Số điện thoại không đúng ! </center></font>";
            }
        }
	public function getUserByAjax($start, $order , $limit , $title) {
		
	}
	public function test()
	{
		$nums = $this->user_model->total_records(array('user_name', 'user_email','user_fullName'), 'don');
		$users = $this->user_model->list_users(10,0,'ASC', 'user_name', 'don', array('user_name', 'user_email','user_fullName'));
		echo $nums;
		var_dump ($users);
	}
	public function login()
	{
		if($this->input->post("btnLogin")){
		    $this->form_validation->set_rules('txtUser', 'Username', 'trim|requuired');
		    $this->form_validation->set_rules('txtPass', 'Password', 'trim|required|min_length[5]|max_length[12]');
		    $this->form_validation->set_message("required", "%s không được bỏ trống");
		    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		    if($this->form_validation->run()){
			$dataUser = array(
			    "username" => $this->input->post("txtUser"),
			    "password" => md5($this->input->post("txtPass")),
			);
			$check = $this->user_model->isValidate($dataUser);
			if($check){
			    $_SESSION['user'] = $check;
			    redirect(base_url('index.php/admin/home/index'));
			}else {
	//                    $this->_check = false;
			    echo "That bai";
			}
		    }
		}
		$this->load->view("user/loginview");
	}
		public function logout(){
			if(isset($_SESSION['user'])){
			unset($_SESSION['user']);
			}
			redirect(base_url('admin/user/index'));
		}
		
		public function checkFormInput(){
			$this->form_validation->set_rules('usr_name','Username', 'required|min_length[6]');
			//$this->form_validation->set_rules('usr_password','Password', 'required|min_length[6]');
			//$this->form_validation->set_rules('usr_retype_password','Retype-Password', 'required|matches[usr_retype_password]');
			$this->form_validation->set_rules('usr_email','Email', 'required|valid_email');
			$this->form_validation->set_rules('usr_address','Address', 'required');
			$this->form_validation->set_rules('usr_phone','Phone', 'required|numeric|min_length[9]|max_length[11]');
			$this->form_validation->set_rules('usr_gender','Gender', 'required');
	
			$this->form_validation->set_message("required","%s không được bỏ trống");
			$this->form_validation->set_message("alpha_numeric","%s chỉ được chứa chữ cái và số");
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d ký tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d ký tự");
			$this->form_validation->set_message("matches","%s không khớp");
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là số");
			$this->form_validation->set_error_delimiters("<span class='error'>","</span>");
		}		
}