<?php
/**
*
*
**/
class D3url extends Base_Controller
{



	public function __construct(){
		parent::__construct();
	}


	public function index()
	{
		$this->load->view('3d2');
	}
}