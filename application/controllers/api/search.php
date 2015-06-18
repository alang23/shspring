<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*@DEC搜索接口
*@Author Alang
*
**/

class Search extends Api_Controller
{
	


	public function __construct()
	{
		parent::__construct();
	}

	//热门搜索关键词列表
	public function index()
	{
		$this->load->model('search_mdl','search');
		$list = array();
		$list = $this->search->getList();
		$kw = array();
		if(count($list)){
			foreach($list as $k => $v){
				$kw[] = $v['kw'];

			}
		}


		$responseData = array(
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>array(
	    		'qrcode'=>base_url().'uploads/productthumb/1.jpg',
	    		'kw'=>$kw
	    		)
	    	);

	    $this->responseData($responseData);

	}

	//实时搜索
	public function realtime()
	{
		$data = $this->requestData();
		$kw = $data['data']['kw'];
		if(empty($kw)){
			$arr = array('brikin35','brikin25','brikin30','lv','爱马仕');
		}

		$responseData = array(
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>$arr
	    	);

		 $this->responseData($responseData);

	}

	//搜索结果
	public function result()
	{
		$data = $this->requestData();
		$kw = $data['data']['kw'];

		$this->load->model('product_mdl','product');
		$list = array();
		
		$page = isset($data['data']['page']) ? $data['data']['page'] : 0;
        
        $where = array();
        $limit = 10;
        $total = $this->product->get_count($where);
        $offset = ($page - 1) * $limit;

        $wherelist = array();
        if(!empty($page)){
		    $wherelist['page'] = true;
		    $wherelist['limit'] = $limit;
		    $wherelist['offset'] = $offset;
        }

	    $wherelist['where'] = $where;
	    $list = $this->product->getList($wherelist);
	       	
	    $response = array();
	    foreach($list as $k => $v){
	       	$tmp['id'] = $v['id'];
	        $tmp['name'] = $v['p_name'];
	        $tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
	        $tmp['price'] = $v['price'];
	        $tmp['discount'] = $v['discount'];
	        $response[] = $tmp;
	   }
		$responseData = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'total'=>$total,
					'items'=>$response
				)
		);

		$this->responseData($responseData);
	}
}