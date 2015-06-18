<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*@DEC 品牌学堂个板块内容
*
*@author Alang
*/
class School extends Api_Controller
{
	


	public  function __construct(){
		parent::__construct();
	} 


	public function index()
	{

	}

	//皮质下的列表
	public function cortex()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$id = $data['data']['id'];
		$page = isset($data['data']['page']) ? $data['data']['page'] : 0;

		//该颜色介绍信息
		$this->load->model('attribute_content_mdl','attribute_content');
		$config = array('id'=>$id);
		$attribute_info = array();
		$attribute_info = $this->attribute_content->get_one_by_where($config);
		$cortex_info = array();
		$cortex_info['name'] = empty($attribute_info['attr_name']) ? "" : $attribute_info['attr_name'];
		$cortex_info['intro'] = empty($attribute_info['attr_intro']) ? "" : $attribute_info['attr_intro'];

		//读取该颜色下的产品	
		$this->load->model('product_mdl','product');
		$list = array();
	
		$wherelist = array();
      	
      	if(!empty($page)){
      		$limit = 10;
	        $total = $this->product->get_count($where);
	        $offset = ($page - 1) * $limit;

		    $wherelist['page'] = true;
		    $wherelist['limit'] = $limit;
		    $wherelist['offset'] = $offset;
      	}

	 
	    $list = $this->product->getList($wherelist);
	    $arr = array();
	    if(!empty($list)){
	    	foreach($list as $k => $v){
	    		$tmp['id'] = $v['id'];
	    		$tmp['name'] = $v['p_name'];
	    		$tmp['price'] = $v['price'];
	    		$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
	    		$arr[] = $tmp;
	    	}
	    }

	    $responseData = array(
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>array(
	    		'cortex_info'=>$cortex_info,
	    		'intro'=>$intro,
	    		'items'=>$arr
	    		)
	    	);

	
	    $this->responseData($responseData);


	}

	//颜色下的列表
	public function color()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$id = $data['data']['id'];
		$page = isset($data['data']['page']) ? $data['data']['page'] : 0;

		//该颜色介绍信息
		$this->load->model('attribute_content_mdl','attribute_content');
		$config = array('id'=>$id);
		$attribute_info = array();
		$attribute_info = $this->attribute_content->get_one_by_where($config);
		$color_info = array();
		$color_info['name'] = $attribute_info['attr_name'];
		$color_info['intro'] = $attribute_info['attr_intro'];

		//读取该颜色下的产品	
		$this->load->model('product_mdl','product');
		$list = array();
      
		$wherelist = array();
      	
      	if(!empty($page)){
      		$limit = 10;
	        $total = $this->product->get_count($where);
	        $offset = ($page - 1) * $limit;

		    $wherelist['page'] = true;
		    $wherelist['limit'] = $limit;
		    $wherelist['offset'] = $offset;
      	}
	
	    $list = $this->product->getList($wherelist);
	    $arr = array();
	    if(!empty($list)){
	    	foreach($list as $k => $v){
	    		$tmp['id'] = $v['id'];
	    		$tmp['name'] = $v['p_name'];
	    		$tmp['price'] = $v['price'];
	    		$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
	    		$arr[] = $tmp;
	    	}
	    }

	    $responseData = array(
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>array(
	    		'color_info'=>$color_info,
	    		'intro'=>$intro,
	    		'items'=>$arr
	    		)
	    	);

	    //echo json_encode($responseData);
	    $this->responseData($responseData);


	}
}