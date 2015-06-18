<?php
/**
*
*@DEC 意见反馈接口
*@Author Alang
**/

class Feedback extends Api_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	//意见反馈提交
	public function index()
	{
		$data = $this->requestData();

		$uid = $data['data']['uid'];
		$content = $data['data']['content'];
		$token = $data['data']['token'];
		
		
		if(!empty($uid) && !empty($content)){
			$this->load->model('feedback_mdl','feedback');
			$add['uid'] = $uid;
			$add['content'] = $content;
			$add['createtime'] = time();
			$this->feedback->add($add);
			$repjson = array('errcode'=>"0",'msg'=>'ok');
		}else{
			$repjson = array('errcode'=>"-1",'msg'=>'提交失败，请重试');
		}	
       
        $this->responseData($repjson);
	}
}