<?php
/**
*@DEC款式列表api
*
**/


class Kuanshi extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();
		$id = $data['data']['id'];

		//简介
		$config = array('id'=>$id);
		$this->load->model('category_mdl','category');
		$cinfo = $this->category->get_one_by_where($config);
		$intro = $cinfo['c_intro'];

		$this->load->model('product_mdl','product');
		$list = array();
		$page = isset($data['data']['page']) ? $data['data']['page'] : 1;
        $where = array('category_id'=>$id);
       	$limit = 10;
        $total = $this->product->get_count($where);
        $offset = ($page - 1) * $limit;

	    $wherelist['page'] = true;
	    $wherelist['limit'] = $limit;
	    $wherelist['offset'] = $offset;
	    $wherelist['where'] = $where;
	    $list = $this->product->getList($wherelist);
	    $arr = array();
	    if(!empty($list)){
	    	foreach($list as $k => $v){
	    		$tmp['id'] = $v['id'];                                          // id
	    		$tmp['name'] = $v['p_name'];                                   // 名称
	    		$tmp['price'] = $v['price'];                                  //价格
	    		$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];   //图片
	    		$tmp['market'] = $v['market'];                               //市场价
	    		$tmp['discount'] = $v['discount'];

	    		$arr[] = $tmp;
	    	}
	    }

	    $responseData = array(
	    	'tag'=>$data['tag'],
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>array(
	    		'name'=>$cinfo['c_name'],
	    		'intro'=>$intro,
	    		'items'=>$arr
	    		)
	    	);

	    //echo json_encode($responseData);
	    $this->responseData($responseData);
	}
}