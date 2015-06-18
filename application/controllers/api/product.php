<?php
/**
*@DEC 产品相关api
*
**/
class Product extends Api_Controller
{
	


	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();

	}

	//产品详情
	public function detail()
	{
		$data = $this->requestData();
		$id = $data['data']['id'];
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		$this->load->model('product_mdl','product');
		$info = array();
		$config = array('pro.id'=>$id);
		$info = $this->product->get_one_by_join($config);

		//图片列表
		$this->load->model('product_pic_mdl','product_pic');
		$where['where'] = array('product_id'=>$id);
		$pic = array();
		$pic = $this->product_pic->getList($where);
		$pics = array();
		if(!empty($pic)){
			foreach($pic as $k => $v){
				$tmp['img'] = base_url().'uploads/product/'.$v['filename'];
				$pics[] = $tmp;
			}
		}


		//收藏
		$this->load->model("fav_mdl",'fav');
		$fav = 0;
		if(!empty($uid)){
			$favconfig = array('uid'=>$uid,'pid'=>$id);
			$favcheck = 0;
			$favcheck = $this->fav->get_count($favconfig);
			if($favcheck){
				$fav = 1;
			}
		}

		//拼装
		$pro['id'] = $info['id'];           //产品id
		$pro['suk'] = $info['suk'];         //编号
		$pro['name'] = $info['p_name'];     //产品名称
		$pro['brand'] = $info['b_name'];    //品牌
		$pro['category'] = $info['c_name']; //类别
		$pro['price'] = $info['price']; //价格
		$pro['market'] = '0.00';  //市场价
		$pro['intro'] = '17点前下单，预计24小时内到达'; 
		$pro['content'] = $info['content'];  //详情
		$pro['3durl'] = base_url().'index.php/d3url';       //查看3d效果图地址
		$pro['fav'] = $fav;              //是否已收藏
		$pro['total'] = $info['total']; //库存
		$pro['level'] = 10;   //几层新
		$pro['types'] = $info['types']; //产品类型,1-新品，2-二手，3-周边
		$pro['discount'] = $info['discount'];   //折扣

		$responseData = array(
			'errcode'=>0,
			'msg'=>'ok',
			'data'=>array(
				'img'=>$pics,
				'info'=>$pro
				)
			);

		$this->responseData($responseData);


	}
}