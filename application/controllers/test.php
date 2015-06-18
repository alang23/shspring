<?php

class Test extends CI_Controller
{
	


	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		/*
		$arr = array(
			'tag'=>'navigate',
			'data'=>array(
				'IMEI'=>'888888888',
				'uid'=>1,
				)
			);

		echo json_encode($arr);
		$this->load->view('test');
		*/
		//header("Content-Type: application/json");
		//$remote_server = 'https://api.leancloud.cn/1.1/requestSmsCode';
		//$post_string = '{"mobilePhoneNumber": "15814073945"}';
		//$remote_server = 'https://api.leancloud.cn/1.1/verifySmsCode/320956?mobilePhoneNumber=15814073945';
		//$str = $this->request_by_curl($remote_server, $post_string);
		//echo $str;
		//$this->load->helper('mobile');
		//$str = verifySmsCode($post_string);
		//$arr = json_decode($str,true);
		//print_r($arr);
		
		//发短信接口
		
		/*
		$arr = array(
			'tag'=>'sendmsg',
			'data'=>array(
				'mobilePhoneNumber'=>'15814073945'
				)
			);
			*/
			

		$arr = array(
			'tag'=>'register',
			'data'=>array(
				'mobilePhoneNumber'=>'15814073945',
				'code'=>'123456',
				'passwd'=>'123456'
				)
			);
			
		$arr = array(
			'tag'=>'login',
			'data'=>array(
				'mobile'=>'15814073945',
				'passwd'=>'123456'
				)
			);

		$arr = array(
			'tag'=>'banner',
			'data'=>array(
				'key'=>'ershou',
				'limit'=>10,
				'offset'=>0
				)
			);

		$arr = array(
			'tag'=>'changepwd',
			'data'=>array(
				'token'=>'12313123',
				'mobilePhoneNumber'=>'13800138000',
				'passwd'=>'123123',
				'newpasswd'=>'123123'
				)
			);

		$arr = array(
			'tag'=>'forgetpwd',
			'data'=>array(
				'mobilePhoneNumber'=>'13800138000',
				'passwd'=>'123123',
				'code'=>'123123'
				)
			);

		$arr = array(
			'tag'=>'kuanshi',
			'data'=>array(
				'id'=>4,
				'page'=>1
				)
			);

		$arr = array(
			'tag'=>'buy',
			'data'=>array(
				'id'=>1,
				'uid'=>1,
				'token'=>'13123',
				'num'=>1
				)
			);



		$arr = array(
			'tag'=>'cart_list',
			'data'=>array(
				'uid'=>1,
				'items'=>array(
						array('id'=>1,'num'=>1,'enabled'=>0),
						array('id'=>2,'num'=>1,'enabled'=>1),
						array('id'=>3,'num'=>1,'enabled'=>1),
						array('id'=>4,'num'=>1,'enabled'=>0),
					)
				)
			);

		//收货地址
		/*
		$arr = array(
			'tag'=>'clearing_address',
			'data'=>array(
				'uid'=>2,
				'token'=>'123123123',
				)
			);
			*/

		$arr = array(
			'tag'=>'cart_submit',
			'data'=>array(
				'uid'=>1,
				'token'=>'ddddd',
				'exp'=>1,
				'exp_id'=>2,
				'invoice'=>1,
				'invoice_title'=>'test',
				'address'=>array(
					'province_id'=>1,
					'city_id'=>1,
					'area_id'=>3,
					'address'=>'shenzhenfutian'
					),
				'hongbao'=>array(
					'id'=>1,
					'code'=>'abcde'
					),
				'items'=>array(
					array('id'=>1,'num'=>2),
					array('id'=>2,'num'=>2),
					)
				)
			);

		//红包
		/*
		$arr = array(
			'tag'=>'hongbao',
			'data'=>array(
				'uid'=>1,
				'token'=>'123123',
				)
			);
			*/

		//添加地址
		/*
		$arr = array(
			'tag'=>'add_address',
			'data'=>array(
				'uid'=>1,
				'token'=>'123123',
				'province_id'=>1,
				'city_id'=>2,
				'area_id'=>3,
				'address'=>'\U554a\U4e0d\U4f1a\U7761\U89c9',
				'mobile'=>'13800138000',
				'zip_code'=>'邮编',
				'realname'=>'admin',
				'id'=>0
				)
			);
			*/
			//删除收货地址
		/*
		$arr = array(
			'tag'=>'del_address',
			'data'=>array(
				'uid'=>1,
				'token'=>'asdfasf',
				'id'=>1
				)
			);
			*/

		$arr = array(
			'tag'=>'selected',
			'data'=>array(
				'uid'=>1,
				'token'=>'asfasf',
				'act'=>0
				)
			);

		$arr = array(
			'tag'=>'updateorderstatus',
			'data'=>array(
				'uid'=>1,
				'token'=>'123123',
				'order_id'=>'6',
				'action'=>'order_cannel'
				)
			);

		
		$binary = file_get_contents("concierge01.jpg");
		$base64 = base64_encode($binary);
		$base64 = urlencode($base64);

		$arr = array(
			'tag'=>'jishou',
			'data'=>array(
				'uid'=>1,
				'name'=>'asdfasdf',
				'token'=>'123123123',
				'price'=>'1888.0',
				'tel'=>'13800138000',
				'intro'=>'简介简介',
				'pic'=>array(
						array('filedata'=>$base64,'extension'=>'jpg'),
						array('filedata'=>$base64,'extension'=>'png'),
					)
				)
			);
			
			
			//我的买家秀
		/*
		$arr = array(
			'tag'=>'my_show',
			'data'=>array(
				'uid'=>1,
				'token'=>'asfasf',
				'page'=>1,
				
				)
			);
			*/
		$json = json_encode($arr);
/*
		$arr = array(
			'tag'=>'school_color',
			'data'=>array(
				'uid'=>0,
				'id'=>'1',
				'page'=>'1'
				)
			);

		$arr = array(
			'tag'=>'feedback',
			'data'=>array(
				'uid'=>'1',
				'token'=>'123123',
				'content'=>'asfasfaf'
				)
			);
			*/

		//echo json_encode($arr);

		//echo base64_encode("concierge01.jpg");
		//$binary = file_get_contents("concierge01.jpg");

		//$base64 = base64_encode($binary);
		//echo $base64;
		//$base64 = urlencode(json_encode($arr));
		$data['data'] = $json;
		//echo $base64;
		
		$this->load->view('test',$data);
		
	}

	function request_by_curl($remote_server, $post_string)
	{
		$header = array(
            'Content-Type: application/json',
            'X-AVOSCloud-Application-Id: oysn6l2ka6ouxmoq0gjg2kzpqhi1ma3wg95h5sjrq5vx73qh',
            'X-AVOSCloud-Application-Key: eq9qq9xa2cwbu2mxwfrf4hrbrnrfhadxcsl4tcilajxrzs9f',
        );

        $curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $remote_server);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_string);
		//curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
		$data = curl_exec($curl);
		curl_close($curl);

		return $data;
	} 

	    // $post_string = "app=request&version=beta";
    function do_post($remote_server, $post_string)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $remote_server);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Jimmy's CURL Example beta");
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	} 
}