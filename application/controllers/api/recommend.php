<?php
/**
*@DEC推荐
*
**/

class Recommend extends Api_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();
		$list = array();

		$this->load->model('product_mdl','product');
		$list = array();
	    $wherelist['page'] = true;
	    $wherelist['limit'] = 5;
	    $wherelist['offset'] = 0;
	    $list = $this->product->getList($wherelist);
	    $arr = array();
	    if(!empty($list)){
	    	foreach($list as $k => $v){
	    		$tmp['id'] = $v['id'];
	    		$tmp['name'] = $v['p_name'];
	    		$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
	    		$tmp['price'] = $v['price'];
	    		$arr[] = $tmp;
	    	}
	    }

	    $responseData = array(
			'errcode'=>0,
			'msg'=>'ok',
			'data'=>array(
				'items'=>$arr
				)
			);

	    $this->responseData($responseData);


	}

}