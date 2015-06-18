<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*@DEC 导航接口
*
**/

class Navigation extends Api_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('indexbanner_mdl','indexbanner');
	}



	public function index()
	{
		$data = $this->requestData();

		$list = array();
		$where['order'] = array('key'=>'rank','value'=>'ASC');
		$list = $this->indexbanner->getList($where);
		$nav = array();
		foreach($list as $k =>$v){
			$tmp['img'] = base_url().'uploads/indexbanner/'.$v['banner_pic'];
			$tmp['title'] = $v['banner_name'];
			$tmp['key'] = $v['banner_key'];
			$tmp['rank'] = $v['rank'];
			$nav[] = $tmp;
		}

		$arr = array(
			'errcode'=>0,
			'msg'=>'OK',
			'data'=>$nav
			);


		echo $this->responseData($arr);
	}
}