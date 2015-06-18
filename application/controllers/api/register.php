<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*@DEC 用户注册
*
**/
class Register extends Api_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}



	/**
	*@DEC用户注册
	*
	*
	**/
	public function index()
	{
		$data = $this->requestData();

		$mobile = $data['data']['mobilePhoneNumber'];
		$authorcode = $data['data']['code'];
		$passwd = $data['data']['passwd'];


		/**验证手机号**/
		$this->load->helper('mobile');
		if(!valid_email($mobile)){
			$response = array(
				'errcode' => -1,
				'msg'=>'不是有效的手机号'
				);
			echo $this->responseData($response);
			exit;
		}


		$this->load->model('member_mdl','member');
		//验证是否已经注册
		$checkconfig = array('phone'=>$mobile);
		$check = $this->member->get_one_by_where($checkconfig);
		if(!empty($check)){

				$response = array(
					'errcode'=>-2,
					'msg'=>'该手机号已经被注册'
				);
			echo $this->responseData($response);
			exit;
		}

		//验证
		$post_string = json_encode(array('mobilePhoneNumber'=>$mobile));
		$result = verifySmsCode($mobile,'verify',$authorcode);
		$jarr = json_decode($result,true);
		if(empty($jarr)){
			//验证通过
			$add['phone'] = $mobile;
			$add['pawd'] = md5($passwd);
			$add['createtime'] = time();
			$add['enabled'] = 1;
			$add['shop_id'] = 1;
			if($this->member->add($add)){

				//添加成功
				$response = array(
					'errcode'=>0,
					'msg'=>'注册成功'
				);
				echo $this->responseData($response);
			}else{
				//添加失败
				$response = array(
					'errcode'=>-3,
					'msg'=>'系统错误，请重试'
				);
				echo $this->responseData($response);
			}

		}else{
			$response = array(
				'errcode'=>-4,
				'msg'=>'验证码错误'
				);
			echo $this->responseData($response);
		}

	}

	public function changepwd()
	{
		$data = $this->requestData();
		$mobile = $data['data']['mobilePhoneNumber'];
		$passwd = $data['data']['passwd'];
		$newpasswd = $data['data']['newpasswd'];

		$this->load->model('member_mdl','member');
		$checkinfo = array();
		$config = array('phone'=>$mobile);
		$checkinfo = $this->member->get_one_by_where($config);
		if(empty($checkinfo)){
			$response = array(
				'errcode'=>-1,
				'msg'=>'用户不存在'
				);
			echo $this->responseData($response);
			exit;
		}

		if($checkinfo['pawd'] != md5($passwd)){
			$response = array(
				'errcode'=>-2,
				'msg'=>'原密码错误'
				);
			echo $this->responseData($response);
			exit;
		}

		$updatedata = array('pawd'=>md5($newpasswd));
		$updateconfig = array('phone'=>$mobile,'id'=>$checkinfo['id']);
		$this->member->update($updateconfig,$updatedata);
		$response = array(
				'errcode'=>0,
				'msg'=>'密码修改成功'
		);
		echo $this->responseData($response);

	}


	/**
	*@dec找回密码
	*
	**/
	public function resetpwd()
	{
		$data = $this->requestData();

		$mobile = $data['data']['mobilePhoneNumber'];
		$authorcode = $data['data']['code'];
		$passwd = $data['data']['passwd'];


		/**验证手机号**/
		$this->load->helper('mobile');
		if(!valid_email($mobile)){
			$response = array(
				'errcode' => -1,
				'msg'=>'不是有效的手机号'
				);
			echo $this->responseData($response);
			exit;
		}


		$this->load->model('member_mdl','member');
		//验证是否已经注册
		$checkconfig = array('phone'=>$mobile);
		$check = $this->member->get_one_by_where($checkconfig);
		if(empty($check)){

				$response = array(
					'errcode'=>-2,
					'msg'=>'账号不存在'
				);
			echo $this->responseData($response);
			exit;
		}

		//验证
		$post_string = json_encode(array('mobilePhoneNumber'=>$mobile));
		$result = verifySmsCode($mobile,'verify',$authorcode);
		$jarr = json_decode($result,true);
		if(empty($jarr)){
			$updateconfig = array('phone'=>$mobile);
			$updatedata['pawd'] = md5($passwd);
			//验证通过
			$this->member->update($updateconfig,$updatedata);
				//添加成功
			$response = array(
				'errcode'=>0,
				'msg'=>'密码修改成功'
			);
			echo $this->responseData($response);
			

		}else{
			$response = array(
				'errcode'=>-4,
				'msg'=>'验证码错误'
				);
			echo $this->responseData($response);
		}
	}



	/**
	*@dec 发短信
	*/
	public function sendmsg()
	{
		$data = $this->requestData();

		$mobile = $data['data']['mobilePhoneNumber'];
				/**验证手机号**/
		$this->load->helper('mobile');
		if(!valid_email($mobile)){
			$response = array(
				'errcode' => -1,
				'msg'=>'号码:'.$mobile.' 不是有效的手机号'
				);
			echo $this->responseData($response);
		}

		//发送短信
		$this->load->helper('mobile');
		$result = verifySmsCode($mobile,'request');
		$jarr = json_decode($result,true);
		if(empty($jarr)){
			$response = array(
				'errcode'=>0,
				'msg'=>'短信发送成功'
			);
		}else{
			$response = array(
				'errcode'=>-2,
				'msg'=>$jarr['error']
			);
		}


		echo $this->responseData($response);
	}

}