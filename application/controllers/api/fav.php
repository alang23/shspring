<?php
/**
*
*@DEC 用户收藏Controller
*
*
**/
class Fav extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('fav_mdl','fav');
		$this->load->model('product_mdl','product');
	}


	public function index()
	{


	
	}

	public function do_fav()
	{
		$data = $this->requestData();

		$pid = $data['data']['pid']; //商品id
		$uid = $data['data']['uid']; //用户id
		$token = $data['data']['token']; //登陆token
		$act = $data['data']['act'];

		if(empty($uid) || empty($token)){
			$responseData = array(
				'errcode'=>-5,
				'msg'=>'添加失败，请先登陆',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}

		//
		if(empty($pid) ||  empty($uid)){
			$responseData = array(
				'errcode'=>-1,
				'msg'=>'缺少参数',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}

		//检查产品
		$config = array('id'=>$pid);
		$pro_info = array();
		$pro_info = $this->product->get_count($config);
		if(empty($pro_info)){
			$responseData = array(
				'errcode'=>-2,
				'msg'=>'产品不存在',
				'data'=>$pro_info
				);

			echo json_encode($responseData);
			exit;
		}

		if($act == 'del'){
			$delconfig = array('uid'=>$uid,'pid'=>$pid);
			$this->fav->del($delconfig);
			$responseData = array(
				'errcode'=>0,
				'msg'=>'成功',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}

		//是否已经存在
		$checkconfig = array('uid'=>$uid,'pid'=>$pid);
		$checkinfo = array();
		$checkinfo = $this->fav->get_count($checkconfig);
		if($checkinfo){
			$responseData = array(
				'errcode'=>-3,
				'msg'=>'无需重复收藏',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}

		$add['uid'] = $uid;
		$add['pid'] = $pid;
		$add['createtime'] = time();
		if($this->fav->add($add)){
			$responseData = array(
				'errcode'=>0,
				'msg'=>'添加成功',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}else{
			$responseData = array(
				'errcode'=>-4,
				'msg'=>'系统错误，请重试',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}
	}


	public function lists()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
			$this->load->model('fav_mdl','fav');
			$list = array();
			$arr = array();
			
			$where = array('uid'=>$uid);
			$page = isset($data['data']['page']) ? $data['data']['page'] : 0;
        	
        	$limit = 10;
        	$total = $this->fav->get_count($where);
        	$offset = ($page - 1) * $limit;
        	$wherelist = array();
        	if(!empty($page)){
		        $wherelist['page'] = true;
		        $wherelist['limit'] = $limit;
		        $wherelist['offset'] = $offset;
        	}

	        $wherelist['where'] = array('fav.uid'=>$uid);
	        $list = $this->fav->get_list_by_join($wherelist);
	       	
	       	$response = array();
	       	if(count($list) > 0){
		        foreach($list as $k => $v){
		        	$tmp['id'] = $v['id'];
		        	$tmp['name'] = $v['p_name'];
		        	$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
		        	$tmp['price'] = $v['price'];
		        	$response[] = $tmp;
		        }
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