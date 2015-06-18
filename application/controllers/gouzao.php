<?php
/**
*@DES 构造页面
*
**/

class Gouzao extends Base_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->load->view('gouzao');
	}
}