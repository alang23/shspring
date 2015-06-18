<?php
/**
*@dec 结算中心Controller
*
**/

class Clearing extends Api_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		//配送方式
		//自提地址
		$takeaway = array();
		$this->load->model('takeaway_mdl','takeaway');
		$takeaway = $this->takeaway->getList();
		$tk = array();
		if(!empty($takeaway)){
			foreach($takeaway as $k => $v){
				$tmp['id'] = $v['id'];
				$tmp['address'] = $v['address'];
				$tmp['tel'] = $v['tel'];
				$tk[] = $tmp;
			}
		}
		$explast = "1";
		$exp = array();
		$exp = array(
			'last'=>$explast,
			'items'=>array(
					'1'=>'快递方式',
					'2'=>$tk,
					'3'=>'2000送货费，24小时配送，偏远地区除外'
				)
			);

		//配送地址
		$this->load->model('user_address_mdl','user_address');
		$where['where'] = array('ar.uid'=>$uid);
		$address = array();
		$address = $this->user_address->get_list_by_join($where);
		$addressarr = array();
		$defaultaddress = array();
		if(!empty($address)){
			foreach($address as $k => $v){
				$tmp['id'] = $v['id'];
				$tmp['realname'] = $v['realname']; //收货人
				$tmp['province_id'] = $v['province_id']; //省份id
				$tmp['city_id'] = $v['city_id']; //城市id
				$tmp['area_id'] = $v['area_id']; //地区id
				$tmp['n1'] = empty($v['n1']) ? "" : $v['n1'];
				$tmp['n2'] = empty($v['n2']) ? "" : $v['n2'];
				$tmp['n3'] = empty($v['n3']) ? "" : $v['n3'];
				$tmp['address'] = $v['address'];
				$tmp['zip'] = $v['zip_code'];
				$tmp['mobile'] = $v['mobile'];
				$addressarr[] = $tmp;
				if(!empty($v['default'])){
					$defaultaddress = $tmp;
				}
			}
		}

		//红包
		$this->load->model('hongbao_mdl','hongbao');
		$whereh['where'] = array('uid'=>$uid,'used'=>0);

		$hongbao = array();
		$hongbao = $this->hongbao->getList($whereh);

		$hb = array();
		if(!empty($hongbao)){
			foreach($hongbao as $k => $v){
				$hbtmp['id'] = $v['id'];
				$hbtmp['codes'] = $v['codes'];
				$hbtmp['amount'] = $v['amount'];
				$hbtmp['intro'] = '红包说明';
				$hb[] = $hbtmp;
			}
		}

		$responseData = array(
			'errcode'=>0,
			'msg'=>'ok',
			'data'=>array(
				'exp'=>$exp,
				'address'=> $defaultaddress,
				'hongbao'=>$hb
				)
			);

		echo json_encode($responseData);
		exit;

	}


	//用户收货地址
	public function address()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];

		$this->load->model('user_address_mdl','user_address');
		$where['where'] = array('ar.uid'=>$uid);
		$address = array();
		$address = $this->user_address->get_list_by_join($where);
		$arr = array();
		$default_id = 0;
		if(!empty($address)){
			foreach($address as $k => $v){
				$tmp['id'] = $v['id'];
				$tmp['realname'] = $v['realname']; //收货人
				$tmp['province_id'] = $v['province_id']; //省份id
				$tmp['city_id'] = $v['city_id']; //城市id
				$tmp['area_id'] = $v['area_id']; //地区id
				$tmp['n1'] = empty($v['n1']) ? "" : $v['n1'];
				$tmp['n2'] = empty($v['n2']) ? "" : $v['n2'];
				$tmp['n3'] = empty($v['n3']) ? "" : $v['n3'];
				$tmp['address'] = $v['address'];
				$tmp['zip'] = $v['zip_code'];
				$tmp['mobile'] = $v['mobile'];
				$arr[] = $tmp;
				if(!empty($v['default'])){
					$default_id = $v['id'];
				}
			}
		}

		$responseData = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'last'=>$default_id,
					'items'=>$arr
					)
				);

			echo json_encode($responseData);
			exit;
	}

	//添加收货地址
	public function add_address()
	{

		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		$province_id = $data['data']['province_id'];
		$city_id = $data['data']['city_id'];
		$area_id = $data['data']['area_id'];
		$address = $data['data']['address'];
		$mobile = $data['data']['mobile'];
		$zip_code = $data['data']['zip_code'];
		$realname = $data['data']['realname'];
		$id = $data['data']['id'];

		if(!empty($province_id) && !empty($city_id) && !empty($address)){
			$this->load->model('user_address_mdl','user_address');
			$add['province_id'] = $province_id;
			$add['city_id'] = $city_id;
			$add['address'] = $address;
			$add['mobile'] = $mobile;
			$add['zip_code'] = $zip_code;
			$add['area_id'] = $area_id;
			$add['realname'] = $realname;
			$add['uid'] = $uid;
			$add['createtime'] = time();

			if(!empty($id)){
				//更新
				$updateconfig = array('id'=>$id,'uid'=>$uid);
				$this->user_address->update($updateconfig,$add);
				$responseData = array(
					'errcode'=>0,
					'msg'=>'修改成功',
					'data'=>array(
						'id'=>"$id"
						)
				);
				echo json_encode($responseData);
				exit;
			}else{
				//添加
					if($this->user_address->add($add)){
						$id = $this->user_address->insert_id();

						$config = array('uid'=>$uid);
						$adddefault['default'] = 0;
						//先重置
						$this->user_address->update($config,$adddefault);

						//设置默认
						$config['id'] = $id;
						$adddefault['default'] = 1;
						$this->user_address->update($config,$adddefault);

						$responseData = array(
							'errcode'=>0,
							'msg'=>'ok',
							'data'=>array(
								'id'=>$id
								)
						);
						echo json_encode($responseData);
						exit;
					}else{
						$responseData = array(
							'errcode'=>-1,
							'msg'=>'系统有误，请重试!',
							);

						echo json_encode($responseData);
						exit;
					}
			}

		}else{
						$responseData = array(
							'errcode'=>-2,
							'msg'=>'添加失败，缺少必要参数',
							);

						echo json_encode($responseData);
						exit;
		}
			
	}


	//删除收货地址
	public function del_address()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		$this->load->model('user_address_mdl','user_address');
		$id = $data['data']['id'];
		$config = array('uid'=>$uid,'id'=>$id);
		if($this->user_address->del($config)){
			$responseData = array(
				'errcode'=>0,
				'msg'=>'删除成功',
			);

			echo json_encode($responseData);
			exit;
		}else{
			$responseData = array(
				'errcode'=>-1,
				'msg'=>'删除失败，请重试',
			);

			echo json_encode($responseData);
			exit;
		}
	}

	//设置默认收货地址
	public function set_default()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$id = $data['data']['id'];

		$config = array('uid'=>$uid);
		$add['default'] = 0;
		//先重置
		$this->load->model('user_address_mdl','user_address');
		$this->user_address->update($config,$add);

		//设置默认
		$config['id'] = $id;
		$add['default'] = 1;
		$this->user_address->update($config,$add);

		$responseData = array(
			'errcode'=>0,
			'msg'=>'修改成功',
		);

		echo json_encode($responseData);
		exit;


	}

	//提交订单
	public function submit()
	{
		$this->load->model('orders_mdl','orders');
		$this->load->model('orders_items_mdl','orders_items');
		$this->load->model('product_mdl','product');
		$this->load->model('cart_mdl','cart');

		$data = $this->requestData();
		$uid = $data['data']['uid'];//用户id
		$token = $data['data']['token']; //token
		$exp = $data['data']['exp']; //配送方式
		$exp_id = $data['data']['exp_id'];
		$invoice = $data['data']['invoice']; //发票
		$invoice_title = $data['data']['invoice_title']; //发票
		//$address = $data['data']['address']['detail'];
		$address = $data['data']['address']['n1'].$data['data']['address']['n2'].$data['data']['address']['n3'];
		$item = $data['data']['items'];
		
		//判断登陆
		$islogin = 1;

		if($islogin){
			$add['exp'] = $exp;
			$add['exp_id'] = $exp_id;
			$add['invoice'] = $invoice;
			$add['invoice_title'] = $invoice_title;
			$add['no'] = 'HM'.time();
			$add['address'] = $address;
			$add['uid'] = $uid;
			$add['status'] = 1;
			$add['createtime'] = time();
			//添加订单基本信息
			if($this->orders->add($add)){
				$order_id = $this->orders->insert_id();
						//计算商品信息
				$tmp = array();
				$ids = array();
				if(!empty($item)){
					foreach($item as $k => $v){
						$tmp[$v['id']]['num'] = $v['num'];
						$ids[] = $v['id'];
					}
				}

				$list = array();
				$where['where_in'] = array('key'=>'id','value'=>$ids);
				$list = $this->product->getList($where);
				$items = array();
				$protmp = array();
				$total = 0;
				if(!empty($list)){
						foreach($list as $k => $v){
							$protmp['pid'] = $v['id'];
							$protmp['order_id'] = $order_id;
							$protmp['p_name'] = $v['p_name'];
							$protmp['img'] = $v['pic'];
							$protmp['num'] = $tmp[$v['id']]['num'];
							$protmp['price'] = $v['price'];
							$total += $v['price'];
							//添加订单日志
							$this->orders_items->add($protmp);
							//删除购物车里的商品
							$delconfig = array('pid'=>$v['id'],'uid'=>$uid);
							$this->cart->del($delconfig);

						}
				}

				$responseData = array(
					'errcode'=>0,
					'msg'=>'订单支付成功',
					'data'=>array(
							'total'=>"$total",          //订单总价
							'order_no'=>(string)$add['no'],
							'order_id'=>"$order_id",    //订单id
							'status'=>'1',             //状态（1.支付成功，2-支付失败，0-未知错误）
					)
						
				);

				$this->responseData($responseData);
				exit;
			}else{
				$responseData = array(
					'errcode'=>-1,
					'msg'=>'未登陆',
					'data'=>array()
				);
				$this->responseData($responseData);
				
				exit;
			}


		}

	}

	//可用红包列表
	public function hongbao()
	{

		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$this->load->model('hongbao_mdl','hongbao');
		$where['where'] = array('uid'=>$uid,'used'=>0);

		$list = array();
		$list = $this->hongbao->getList($where);

		$hb = array();
		if(!empty($list)){
			foreach($list as $k => $v){
				$tmp['id'] = $v['id'];
				$tmp['codes'] = $v['codes'];
				$tmp['amount'] = $v['amount'];
				$tmp['intro'] = '红包说明';
				$tmp['status'] = $v['used'];     //红包状态(1-已经使用，0-未使用)
				$hb[] = $tmp;
			}
		}

		$responseData = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'items'=>$hb
					)
				);

			echo json_encode($responseData);
			exit;

	}

}