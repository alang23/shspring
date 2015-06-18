<?php
/**
*DEC 构造
*
**/
class Gouzao extends Api_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		
		$responseData = array(
				'errcode'=>0,
				'msg'=>'200',
				'data'=>array(
					'url'=>base_url().'index.php/gouzao',
					)
		);

		$this->responseData($responseData);
	}


}