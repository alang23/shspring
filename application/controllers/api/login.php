<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*@DEC用户登录接口
*
**/

class Login extends Api_Controller
{


	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();

		$mobile = $data['data']['mobile'];
		$passwd = $data['data']['passwd'];
		if(!empty($mobile) && !empty($passwd)){
			$this->load->model('member_mdl','member');
			$checkconfig = array('phone'=>$mobile);
			$check = $this->member->get_one_by_where($checkconfig);
			//用户不存在
			if(empty($check)){
				$response = array(
					'errcode' => -1,
					'msg'=>'该用户不存在'
					);
				echo $this->responseData($response);
				exit;
			}

			//检验密码
			if($check['pawd'] != md5($passwd)){
				$response = array(
					'errcode' => -2,
					'msg'=>'密码错误'
					);
				echo $this->responseData($response);
				exit;
			}

			//登录成功-更新数据
			$updatedata['lastlogin'] = time();
			$updatedata['token'] = md5(time());
			$this->member->update($checkconfig,$updatedata);

			//输出
			$user['id'] = $check['id'];
			$user['username'] = empty($check['username']) ? '河马' : $check['username'];
			$user['mobile'] = $check['phone'];
			$user['gender'] = $check['gender'];
			$user['headerurl'] = base_url().'uploads/member/'.$check['photo'];
			$user['lastlogin'] = date("Y-m-d H:i:s",$check['lastlogin']);
			$user['token'] = $updatedata['token'];

			$response = array(
				'errcode' => 0,
				'msg'=>'登录成功',
				'data'=>$user
			);
			echo $this->responseData($response);
			exit;

		}
	}

	//退出登录
	public function logout()
	{
		$data = $this->requestData();
		$uid = $data['data']['uid'];
		$token = $data['data']['token'];

		$islogin = 1;
		if($islogin){
			$this->load->model('member_mdl','member');
			$config = array('id'=>$uid);
			$updatedata = array('token'=>'');
			$this->member->update($config,$updatedata);

			$responseData = array(
				'errcode' => 0,
				'msg'=>'成功退出登录'
			);
			
		}else{
			$responseData = array(
				'errcode' => -1,
				'msg'=>'退出登录失败，请重试'
			);
		}
		
		$this->responseData($responseData);

	}
}