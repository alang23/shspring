<?php
/**
*@dec(购物车COntroller)
*
**/
class Cart extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_mdl','product');
		$this->load->model('cart_mdl','cart');
	}


	//购物车列表
	public function index()
	{

		$data = $this->requestData();

		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		$list = array();
		$where['where'] = array('c.uid'=>$uid);
		$list = $this->cart->get_list_by_join($where);
		$items = array();
		$protmp = array();
		$total = 0;
		$count = 0;
		if(!empty($list)){
				foreach($list as $k => $v){
						
						$protmp['id'] = $v['id'];
						$protmp['name'] = $v['p_name'];
						$protmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
						$protmp['num'] = ($v['total'] >= $v['num']) ? $v['num'] : $v['total'];				
						$protmp['price'] = $v['price'];
						$protmp['total'] = (string)($protmp['num'] * $v['price']);
						$protmp['enabled'] = $v['enabled'];
						$protmp['label'] = ($v['total'] > $tmp['num']) ? '' : '库存不足';
						$count += $protmp['num'];
						$items[] = $protmp;
						$total += empty($protmp['enabled']) ? 0 : $protmp['total']; //
					
				}
		}

		$responseData = array(
				'errcode'=>0,
				'msg'=>'列表',
				'data'=>array(
					'count'=>$count,
					'total' => "$total",
					'intro' => '获得积分',
					'items'=>$items
					)
		);

		$this->responseData($responseData);
		


	}

	//添加到购物车
	public function buy()
	{

		$data = $this->requestData();
		$pid = $data['data']['pid']; //商品id
		$uid = $data['data']['uid']; //用户id
		$token = $data['data']['token']; //登陆token
		$num = $data['data']['num']; //数量
		$enabled = $data['data']['enabled'];

		/*
		if(empty($pid) || empty($num) || empty($uid)){
			$responseData = array(
				'errcode'=>-1,
				'msg'=>'缺少参数',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}
		*/
		$islogin = $uid;
		if(empty($islogin)){
			$responseData = array(
				'errcode'=>-1,
				'msg'=>'未登录',
				'data'=>array()
				);

			echo json_encode($responseData);
			exit;
		}

		//检查产品
		$config = array('id'=>$pid);
		$pro_info = array();
		$pro_info = $this->product->get_one_by_where($config);
		if(empty($pro_info)){
			$responseData = array(
				'errcode'=>-2,
				'msg'=>'产品不存在',
				'data'=>array()
				);

			$this->responseData($responseData);
			exit;
		}

		$cartcheckconfig = array('uid'=>$uid,'pid'=>$pid);

		//如果数量为零，直接删除
		$checkcart = 0;
		$checkcart = $this->cart->get_one_by_where($cartcheckconfig);
		if(!empty($checkcart)){
			//如果商品数量为0则删除商品
			if(($checkcart['num']+$num) <= 0){
				$this->cart->del($cartcheckconfig);
				$responseData = array(
					'errcode'=>0,
					'msg'=>'产品添加成功',
					'data'=>array()
				);
				$this->responseData($responseData);
			}
		
			//1.检查库存
			if(($checkcart['num']+$num) > $pro_info['total']){
				$responseData = array(
					'errcode'=>-3,
					'msg'=>'库存不够',
					'data'=>array()
					);

				$this->responseData($responseData);
				exit;
			}
			//更新购物车
			$updatedata['num'] = $checkcart['num']+$num;
			$updatedata['enabled'] = $enabled;
			$this->cart->update($cartcheckconfig,$updatedata);
			$responseData = array(
				'errcode'=>0,
				'msg'=>'产品添加成功',
				'data'=>array()
			);

			$this->responseData($responseData);

		}else{
			//添加购物车
			$add['pid'] = $pro_info['id'];
			$add['num'] = $num;
			$add['createtime'] = time();
			$add['uid'] = $uid;
			if($this->cart->add($add)){
				$responseData = array(
					'errcode'=>0,
					'msg'=>'产品添加成功',
					'data'=>array()
					);

				$this->responseData($responseData);
				exit;
			}else{
				$responseData = array(
					'errcode'=>-4,
					'msg'=>'系统有误，请重试',
					'data'=>array()
					);

				$this->responseData($responseData);
				exit;
			}
		}

	}

	//购物车全选/全不选
	public function selected()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$act = $data['data']['act'];

		$config = array('uid'=>$uid);
		if($act == 1){
			$updatedata['enabled'] = 1;
		}elseif($act == 0){
			$updatedata['enabled'] = 0;
		}

		$this->cart->update($config,$updatedata);

		$responseData = array(
			'errcode'=>0,
			'msg'=>'操作成功'
			//'data'=>$data
			
		);

		echo json_encode($responseData);
		exit;
	}



}