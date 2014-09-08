<?php

class Order extends BaseAdminController 
{

	public function __consruct() 
	{
		parent::__consruct();
		$this->load->model('order_model');
		$this->load->model('config_model');		
	}

	/**
	* get all order 
	*/
	public function index($start, $limit = 7)
	{
		$limit = $this->config_model->number_per_page();
		$orders = $this->order_model->list_orders($start, $limit, $order = 'ASC', $title = 'order_date');
		$this->data['orders'] = $orders;
		$this->layout->view('order/list_order', $this->data);
	}

}