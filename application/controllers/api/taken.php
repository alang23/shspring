<?php
/**
*@DEC全球街拍接口
*@Author alang
**/


class Taken extends Api_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	//输出h5地址
	public function index()
	{

		$responseData = array(
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>array(
	    		'url'=>base_url().'index.php/taken',
	    		)
	    	);

	    $this->responseData($responseData);
	}

	//全球街拍列表
	public function lists()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		$this->load->model('taken_mdl','taken');

		$list = array();
		$page = isset($data['data']['page']) ? $data['data']['page'] : 0;
   
       	$limit = 10;
        $total = $this->taken->get_count();
        $offset = ($page - 1) * $limit;
        //页数为空则输出所有数据
        $wherelist = array();
        if(!empty($page)){
		        $wherelist['page'] = true;
		        $wherelist['limit'] = $limit;
		        $wherelist['offset'] = $offset;
       }

       $list = $this->taken->getList($wherelist);
       $takenarr = array();
       foreach($list as $k => $v){
       		$tmp['id'] = $v['id'];
       		$tmp['title'] = $v['title'];
       		//$tmp['img'] = base_url().'uploads/taken/'.$v['img'];
       		$img = $this->get_img_size('./uploads/taken/'.$v['img']);
       		$tmp['img'] = array(
       			'url'=>base_url().'uploads/taken/'.$v['img'],
       			'width'=>$img[0],
       			'height'=>$img[1],
       			'percentage'=>$img[0]/$img[1]
       			);
       		$takenarr[] = $tmp;
       }


		$responseData = array(
	    	'errcode'=>0,
	    	'msg'=>'ok',
	    	'data'=>array(
	    			'detailurl'=>base_url().'index.php/taken/detail',
	    			'items'=>$takenarr
	    		)
	    	);

	    $this->responseData($responseData);

	}

	private function get_img_size($image) {
		 $size = getimagesize($image);
		
		 return $size;
	}
	
}