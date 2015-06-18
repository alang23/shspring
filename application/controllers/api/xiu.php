<?php
/**
*
*@DEC 买家秀Controller
*@Author Alang
**/

class Xiu extends Api_Controller
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
		$pic = $data['data']['pic'];
		$intro = $data['data']['intro'];

		//保存进本信息
		$add['intro'] = $intro;
		$add['uid'] = $uid;
		$add['createtime'] = time();
		$this->load->model('xiu_mdl','xiu');
		$this->load->model('xiu_pic_mdl','xiu_pic');
		$picnum = 0;//上传成功的图片数
		if($this->xiu->add($add)){
			$xid = $this->xiu->insert_id();
			if(is_array($pic) && count($pic)){
				foreach($pic as $k =>$v){
					$filedata = $v['filedata'];
					$extension = $v['extension'];
					$filename = $this->savepic($filedata,$extension);
					if(!empty($filename)){
						$picnum++;
						$addpic['img'] = $filename;
						$addpic['xid'] = $xid;
						$this->xiu_pic->add($addpic);
					}
				}
			}
			$responseData = array(
				'errcode'=>"0",
				'msg'=>"上传成功",
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

	//我的买家秀
	public function my_show()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		//买家秀基本信息
		$this->load->model('xiu_mdl','xiu');
		$this->load->model('xiu_pic_mdl','xiu_pic');

		$list = array();
		$page = isset($data['data']['page']) ? $data['data']['page'] : 0;
        $where = array('uid'=>$uid);
       	$limit = 10;
        $total = $this->xiu->get_count($where);
        $offset = ($page - 1) * $limit;

        $wherelist = array();
        if(!empty($page)){
		    $wherelist['page'] = true;
		    $wherelist['limit'] = $limit;
		    $wherelist['offset'] = $offset;
		    $wherelist['where'] = $where;
        }

	    $list = $this->xiu->getList($wherelist);

	    $ids = array();
	    if(count($list) > 0){
	    	foreach($list as $k => $v){
	    		$ids[] = $v['id'];
	    	}
	    }

	    $pic = array();
	    $wherepic['where_in'] = array('key'=>'xid','value'=>$ids);
	    $pic = $this->xiu_pic->getList($wherepic);
	    if(count($pic)){
	    	foreach($pic as $k2 => $v2){
	    		$tmp[$v2['xid']][] = base_url().'uploads/xiu/'.$v2['img'];
	    	}
	    }

	    $img = array();
	    foreach($list as $k3 => $v3){
	    	$tmp2['id'] = $v3['id'];
	    	$tmp2['intro'] = $v3['intro'];
	    	$tmp2['year'] = date("Y",$v3['createtime']);
	    	$tmp2['month'] = date("m",$v3['createtime']);
	    	$tmp2['day'] = date("d",$v3['createtime']);
	    	$tmp2['img'] = isset($tmp[$v3['id']]) ? $tmp[$v3['id']] : array();
	    	$tmp2['img_num'] = count($tmp2['img']);
	    	$img[] = $tmp2;
	    }

	   	$responseData = array(
			'errcode'=>"0",
			'msg'=>'200',
			'data'=>array(
				'items'=>$img
				)
				
		);

		$this->responseData($responseData);


	}

	//买家秀列表
	public function lists()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		//买家秀基本信息
		$this->load->model('xiu_mdl','xiu');
		$this->load->model('xiu_pic_mdl','xiu_pic');

		//图片
		$pic = array();
		$pic = $this->xiu_pic->getList();
		if(count($pic) > 0){
			foreach($pic as $k => $v){
				$tmp[$v['xid']][] = $v['img'];
			}
		}

		$list = array();
		$page = isset($data['data']['page']) ? $data['data']['page'] : 0;
       	$limit = 10;
        $total = $this->xiu->get_count();
        $offset = ($page - 1) * $limit;

        $list = array();
        $items = array();
        $list = $this->xiu->getList();
        if(count($list) > 0){
        	foreach($list as $k => $v){
        		$tmp2['id'] = $v['id'];

        		$tmp2['img'] = isset($tmp[$v['id']][0]) ? base_url().'uploads/xiu/'.$tmp[$v['id']][0] : base_url().'uploads/xiu/h_1433746086_9546.jpg';
        		$tmp2['title'] = $v['intro'];
        		$tmp2['reply'] = "100";
        		$tmp2['see'] = '888';
        		$tmp2['zan'] = '1';
        		$items[] = $tmp2;
        	}
        }

        /*
        $items = array(
        	array(
        		'id'=>1,
        		'img'=>base_url().'uploads/xiu/h_1433746086_9546.jpg',
        		'title'=>'title',
        		'reply'=>'100',
        		'see'=>'200',
        		'zan'=>'1'
        		),
        	array(
        		'id'=>1,
        		'img'=>base_url().'uploads/xiu/h_1433746086_9546.jpg',
        		'title'=>'title',
        		'reply'=>'100',
        		'see'=>'888',
        		'zan'=>'0'
        		),
        	array(
        		'id'=>1,
        		'img'=>base_url().'uploads/xiu/h_1433746086_9546.jpg',
        		'title'=>'title',
        		'reply'=>'888',
        		'see'=>'678',
        		'zan'=>'1'
        		),
       	);
       	*/

       $responseData = array(
			'errcode'=>"0",
			'msg'=>'200',
			'data'=>array(
				'items'=>$items
				)
				
		);

       $this->responseData($responseData);


	}

	//买家秀详情
	public function detail()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$id = $data['data']['id'];

		//买家秀基本信息
		$this->load->model('xiu_mdl','xiu');
		$this->load->model('xiu_pic_mdl','xiu_pic');

		//详情基本信息
		$info = array();
		$config['where'] = array('x.id'=>$id);
		$info = $this->xiu->get_one_by_join($config);

		//检查是否存在
		if(empty($info)){
	       $responseData = array(
				'errcode'=>"-1",
				'msg'=>'数据不存在',
				'data'=>array()										
			);
	       $this->responseData($responseData);
		}

		//图片集
		$where['where'] = array('xid'=>$info['id']);
		$pic = array();
		$pic = $this->xiu_pic->getList($where);


		$img = array();
		if(count($pic)){
			foreach($pic as $k => $v){
				$img[] = base_url().'uploads/xiu/'.$v['img'];
			}
		}

		$base_info = array(
			'username'=>$info['username'],
			'photo'=>base_url().'uploads/member/'.$info['photo'],
			'timeline'=>'两天前',
			'zan'=>"520",
			'intro'=>$info['intro'],
			'img'=>$img
		);

		//接口数据输出
       $responseData = array(
			'errcode'=>"0",
			'msg'=>'200',
			'data'=>$base_info
				
				
		);

       $this->responseData($responseData);


	}

	//删除买家秀
	public function del()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];
		$id = $data['data']['id'];

		$config =array('uid'=>$uid,'id'=>$id);
		$this->load->model('xiu_mdl','xiu');
		$this->xiu->del($config);

				//接口数据输出
       $responseData = array(
			'errcode'=>"0",
			'msg'=>'删除成功',
			'data'=>array()
				
				
		);

       $this->responseData($responseData);

	}


	//买家秀图片上传
	private function savepic($filedata,$extension)
	{
		$dir = FCPATH.'/uploads/xiu/';

		$filedata = str_replace(' ', '', $filedata);

		$filedata = urldecode($filedata);
	
		$img = base64_decode($filedata);
		$time = time();
		$rnd = mt_rand(0,9999);
		$filename = 'h_'.$time.'_'.$rnd.'.'.$extension;
		$filedir = $dir.$filename;
		if(file_put_contents($filedir,$img)){
			
			return $filename;
		 }else{
			return '';
       	
		 }
	}


}