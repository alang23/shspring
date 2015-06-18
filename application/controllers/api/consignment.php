<?php
/**
*@寄售商品接口
*
*@author alang
**/
class Consignment extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
	}



	public function index()
	{

	}


	//提交寄售申请
	/**
	*int uid
	*String token 
	*String intro  描述
	*Array img     图片
	*/
	public function submit()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$pic = $data['data']['pic'];
		$intro = $data['data']['intro'];//产品描述
		$price = $data['data']['price'];
		$productname = $data['data']['name'];
		$tel = $data['data']['tel'];

		//保存进本信息
		$add['intro'] = $intro;
		$add['uid'] = $uid;
		$add['createtime'] = time();
		$ran = mt_rand(1,999);
		$add['suk'] = 'SH'.$ran.time();
		$this->load->model('consignment_mdl','consignment');
		$this->load->model('consignment_pic_mdl','consignment_pic');
		//$picnum = 0;//上传成功的图片数

		$suk = 'sp'.time();
		$add['pro_name'] = $productname;
		$add['price'] = $price;
		$add['intro'] = $intro;
		$add['uid'] = $uid;
		$add['tel'] = $tel;
		$add['status'] = 0;

		if($this->consignment->add($add)){

			$conid = $this->consignment->insert_id();
			
			if(is_array($pic) && count($pic)){
				foreach($pic as $k =>$v){
					$filedata = $v['filedata'];
					$extension = $v['extension'];
					$filename = $this->savepic($filedata,$extension);
					if($k == 1){
						$product_pic = $filename;
					}
					if(!empty($filename)){
						$picnum++;
						$addpic['img'] = $filename;
						$addpic['conid'] = $conid;
						$this->consignment_pic->add($addpic);
					}
				}
			}
			$updatedata = array('img'=>$filename);
			$updateconfig = array('id'=>$conid);
			$this->consignment->update($updateconfig,$updatedata);
			$responseData = array(
				'errcode'=>"0",
				'msg'=>"$picnum",
				'data'=>array('upload_img_num'=>$picnum)
			);
			
		}else{

			$responseData = array(
				'errcode'=>"-1",
				'msg'=>'上传有误，请重试',
				'data'=>array()
				
			);
		}

		$this->responseData($responseData);

	}


	//个人寄售列表
	public function lists()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		
		//$this->load->model('consignment_mdl','consignment');
		$this->load->model('product_mdl','product');
		$where['where'] = array('uid'=>$uid,'types'=>4);
		$list = array();
		$list = $this->product->getList($where);
		//名称，寄售价格，寄售时间，查看数，收藏数，图片
		$con_arr = array();
		if(!empty($list)){
			foreach($list as $k => $v){
				$tmp['id'] = $v['id'];                                       //id
				$tmp['name']= $v['p_name'];                                //名称
				$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];   //图片
				$tmp['price'] = $v['price'];                                  //价格
				$tmp['createtime'] = date("Y-m-d",$v['createtime']);    //寄售时间
				$tmp['collection'] = 100;
				$tmp['exposed'] = 200;
				$tmp['status'] = 1;
				$con_arr[] = $tmp;
			}
		}
		//寄售表里未审核和审核失败的
		$this->load->model('consignment_mdl','consignment');
		$con_where['where'] = array('status'=>0);
		$con_list = $this->consignment->getList($con_where);
		if(count($con_list)){
			foreach($con_list as $k2 => $v2){
				$tmp['id'] = $v2['id'];                                       //id
				$tmp['name']= $v2['pro_name'];                                //名称
				$tmp['img'] = base_url().'uploads/productthumb/'.$v2['img'];   //图片
				$tmp['price'] = $v2['price'];                                  //价格
				$tmp['createtime'] = date("Y-m-d",$v2['createtime']);    //寄售时间
				$tmp['collection'] = 100;
				$tmp['exposed'] = 200;
				$tmp['status'] = $v2['status'];
				$con_arr[] = $tmp;
			}
		}

		$responseData = array(
				'errcode'=>"0",
				'msg'=>'200',
				'data'=>array(
					'items'=>$con_arr
					)
				
		);

		$this->responseData($responseData);
	}


	//删除寄售
	public function del()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$id = $data['data']['id'];

		$this->load->model('product_mdl','product');
		$this->load->model('product_pic_mdl','product_pic');

		$delconfig = array('id'=>$id);
		$this->product->del($delconfig);
		$del_pic_config = array('product_id'=>$id);
		$this->product_pic->del($del_pic_config);

		$responseData = array(
				'errcode'=>"0",
				'msg'=>'操作成功',
				'data'=>array(
				)
				
		);

		$this->responseData($responseData);
	}


	//寄售图片保存
	private function savepic($filedata,$extension)
	{
		$dir = FCPATH.'/uploads/productthumb/';

		$filedata = str_replace(' ', '', $filedata);

		$filedata = urldecode($filedata);
	
		$img = base64_decode($filedata);
		$time = time();
		$rnd = mt_rand(0,9999);
		$filename = 'h_'.$time.'_'.$rnd.'.'.$extension;
		$filedir = $dir.$filename;
		if(file_put_contents($filedir,$img)){
			//return true;
			return $filename;
		 }else{
			return '';
       	
		 }
	}

}