<?php
/**
*@DEC 订单管理Controller
*@author Alang
*/

class Orders extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
	}

	//默认 action
	public function index()
	{

	}

	//全部列表
	public function lists()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		//用户所有订单列表
		$this->load->model('orders_mdl','orders');
		$where['where'] = array('uid'=>$uid);
		$orderlist = array();
		$orderlist = $this->orders->getList($where);

		//订单商品
		$this->load->model('orders_items_mdl','orders_items');
		$itemswhere['where'] = array('o.uid'=>$uid);
		$items = array();
		$items = $this->orders_items->get_list_by_join($itemswhere);

		$order_arr = array();
		if(!empty($items)){
			foreach($items as $k => $v){
				$tmp[$v['order_id']]['img'][] = base_url().'uploads/productthumb/'.$v['pic'];
				$tmp[$v['order_id']]['total'] += $v['price'].$v['num'];
				$tmp[$v['order_id']]['num'][] = $v['id'];
			}
		}

		//组合订单信息
		$result = array();
		if(!empty($orderlist)){
			foreach($orderlist as $k2 => $v2){
				$tmp2['order_id'] = $v2['id'];
				$tmp2['no'] = (string)$v2['no'];
				$tmp2['img'] = isset($tmp[$v2['id']]['img']) ? $tmp[$v2['id']]['img'] : array();
				$tmp2['total'] = isset($tmp[$v2['id']]['total']) ? (string)$tmp[$v2['id']]['total'] : 0;
				$tmp2['status'] = (string)$v2['status'];
				$tmp2['num'] = (string)count($tmp[$v2['id']]['num']);
				$result[] = $tmp2;
			}
		}

		$responseData = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'items'=>$result
					)
				);

			echo json_encode($responseData);
			exit;


	}

	//订单详情
	public function detail()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$order_id = $data['data']['order_id'];
		$islogi = 1;
		
		//订单基本信息
		$this->load->model('orders_mdl','orders');
		$order_info = array();
		$config = array('id'=>$order_id);
		$order_info = $this->orders->get_one_by_where($config);

		//商品列表
		$this->load->model('orders_items_mdl','orders_items');
		$list = array();
		$where['where'] = array('oi.order_id'=>$order_id);
		$list = $this->orders_items->get_list_by_join($where);

		$product = array();
		$total = 0;   //商品总价
		if(!empty($list)){
			foreach($list as $k => $v){
				$tmp['product_id'] = $v['id'];
				$tmp['product_name'] = empty($v['p_name_o']) ? '' : $v['p_name_o'];
				$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
				$tmp['price'] = (string)$v['price'];
				$tmp['num'] = (string)$v['num'];
				$tmp['total'] = (string)$v['price']*$v['num'];
				$product[] = $tmp;
				$total += $tmp['total'];
			}
		}

		//配送相关信息
		$this->load->helper('orders');
		$exp = array();
		$exp['user'] = 'admin';
		$exp['exp_type'] = (string)exp_type($order_info['exp']);
		$exp['address'] = empty($order_info['address']) ? "" : $order_info['address'];

		//拼接接口数据
		//
		$orderinfo = array(
			'order_no'=>(string)$order_info['no'], //订单号
			'order_time'=>date("Y-m-d H:i:s",$order_info['createtime']),
			'order_status'=>$order_info['status'],
			'invoice_type'=>isset($order_info['invoice']) ? (string)$order_info['invoice'] : "0",
			'invoice_title'=> empty($order_info['invoice_title']) ? "" : $order_info['invoice_title']
			);
		
		//配送方式拼接
		$msg = '';
		if($order_info['status'] == 4){
			$msg = '';
		}else{
			$msg = '提示语';
		}

		//发票
		/*
		$invoice = array(
			'invoice_type'=>isset($order_info['invoice']) ? (string)$order_info['invoice'] : "0",
			'invoice_title'=> empty($order_info['invoice_title']) ? "" : $order_info['invoice_title']
			);
		*/
		$responseData = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'order_detail'=>$orderinfo, //订单基本信息
					'exp_info'=>$exp,         // 配送信息
					//'invoice_info'=>$invoice,
					'products'=>array(        //商品列表
						'total'=>(string)$total,      //商品总价
						'items'=>$product     //商品列表
					),  
					//折扣
					'discount'=>array(
							array('title'=>'红包','price'=>"100"),
							array('title'=>'优惠券','price'=>"0")
						), 
					'intro'=>'这里是备注',     // 订单备注信息
					'msg'=>$msg,           //顶部提示语
					'payment_total'=>(string)$total            //订单应付总额
					)
				);

			echo json_encode($responseData);
			exit;

	}

	//订单状态处理(前端：1-支付，2-取消)
	public function update_order_status()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$order_id = $data['data']['order_id'];
		$action = $data['data']['action'];

		//验证订单真是性
		$this->load->model('orders_mdl','orders');
		$config = array('uid'=>$uid,'id'=>$order_id);
		$order_info = $this->orders->Get_one_by_where($config);

		//订单不存在
		if(empty($order_info)){
			$responseData = array(
				'errcode'=>-2,
				'msg'=>'订单不存在',
				'data'=>array()
			);

			echo json_encode($responseData);
			exit;

		}

		//检验操作
		//0-未付款，1-待发货，2-待签收，3-完成，4-失败
		if($action == 'order_cannel'){ //取消订单
			//取消订单
			$updatedata = array('status'=>4);

		}elseif($action == 'order_payment'){  //支付
			$updatedata = array('status'=>2);
		}else{
			$updatedata = array();
		}

		$this->orders->update($config,$updatedata);
		$responseData = array(
			'errcode'=>"0",
			'msg'=>'修改成功',
			'data'=>array()
		);

		echo json_encode($responseData);
		exit;

	}


	//用户再次购买
	public function buy_again2()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$order_id = $data['data']['order_id'];
		
		//商品
		$this->load->model('orders_items_mdl','orders_items');
		$where['where'] = array('oi.order_id'=>$order_id);
		$order_product = array();
		$order_product = $this->orders_items->buy_again_list($where);

		$items = array();
		if(count($order_product)){
			foreach($order_product as $k => $v){
					$protmp['id'] = $v['pid'];
					$protmp['name'] = $v['p_name'];
					$protmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
					$protmp['num'] = ($v['total'] >= $v['num']) ? $v['num'] : $v['total'];				
					$protmp['price'] = $v['price'];
					$protmp['total'] = (string)($protmp['num'] * $v['price']);	
					$protmp['enabled'] = "1";	
					$protmp['label'] = ($v['total'] > $v['num']) ? '' : '库存不足';
					$items[] = $protmp;
					$total += $protmp['total']; //
			}
		}

		$responseData = array(
			'errcode'=>"0",
			'msg'=>'200',
			'data'=>array(
				'products'=>$items
				)
		);

		echo json_encode($responseData);
		exit;
		
	}

	//物流跟踪
	public function logistics()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$order_id = $data['data']['order_id'];

		$list = array(
			array('info'=>'您的订单又顺丰配送','time'=>'2015/06/07 18:06'),
			array('info'=>'到仓库','time'=>'2015/06/07 18:06'),
			array('info'=>'配送','time'=>'2015/06/07 18:06')
			);


		$responseData = array(
			'errcode'=>"0",
			'msg'=>'200',
			'data'=>array(
				'order_no'=>'HM88888888',
				'exp_log'=>$list
				)
		);

		//echo json_encode($responseData);
		//exit;
		$this->responseData($responseData);

	}

	//再次购买
	public function buy_again()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$order_id = $data['data']['order_id'];

		$this->load->model('orders_items_mdl','orders_items');
		$where['where'] = array('oi.order_id'=>$order_id);

		$list = array();
		$list = $this->orders_items->buy_again_list($where);
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
						//$total += empty($protmp['enabled']) ? 0 : $protmp['total']; //	
						$total += $protmp['total'];				
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

}