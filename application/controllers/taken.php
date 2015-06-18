<?php
/**
*@dec 街拍详情
*
**/
class Taken extends Base_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('taken_mdl','taken');
	}

	public function index()
	{

	}

	//
	public function detail()
	{
		$id = $this->input->get('id');
		$config = array('id'=>$id);

		$info = array();
		$info = $this->taken->get_one_by_where($config);
		$data['info'] = $info;
		
		$this->load->view('taken/taken',$data);

	}



}