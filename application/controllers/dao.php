<?php
/**
*@DEC
*
**/

class Dao extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->load->model('test_mdl','test');
		$this->load->model('brand_mdl','brand');

		$list = array();
		$list = $this->test->getList();

		foreach($list as $k => $v){
			$add['b_name'] = $v['brand'];
			$add['b_name_cn'] = $v['cnbrand'];
			$add['shop_id'] = 1;
			$add['b_story'] = $v['cnbrand'];
			$this->brand->add($add);
		}


	}
}