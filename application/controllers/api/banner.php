<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*@dec首页各板块内容
*
**/
class Banner extends Api_Controller
{



	public function __construct()
	{
		parent::__construct();
		$this->load->model('style_mdl','style');
	}



	public function index()
	{
		$data = $this->requestData();

		$key = $data['data']['key'];
		if($key == 'kuanshi'){
			$list  = array();
			$banner = array();
			$where['order'] = array('key'=>'rank','value'=>'asc');
			$list = $this->style->getList($where);
			if(!empty($list)){
				foreach($list as $k => $v){
					$tmp['img'] = base_url().'uploads/banner/'.$v['img'];
					$tmp['id'] = $v['category_id'];
					$banner[] = $tmp;
				}
			}
			$arr = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>$banner
			);
		}elseif($key == 'ershou' || $key == 'zhoubian'){
			//二手
			$this->load->model('product_mdl','product');
			$list = array();
			$arr = array();
			if($key == 'ershou'){
				$where = array('types'=>2);
			}elseif($key == 'zhoubian'){
				$where = array('types'=>3);
			}
			$page = isset($data['data']['page']) ? $data['data']['page'] : 1;
        	
        	$limit = 10;
        	$total = $this->product->get_count($where);
        	$offset = ($page - 1) * $limit;

	        $wherelist['page'] = true;
	        $wherelist['limit'] = $limit;
	        $wherelist['offset'] = $offset;
	        $wherelist['where'] = $where;
	        $list = $this->product->getList($wherelist);
	       	
	       	$response = array();
	        foreach($list as $k => $v){
	        	$tmp['id'] = $v['id'];
	        	$tmp['name'] = $v['p_name'];
	        	$tmp['img'] = base_url().'uploads/productthumb/'.$v['pic'];
	        	$tmp['price'] = $v['price'];
	        	$tmp['discount'] = $v['discount'];
	        	$tmp['market'] = $v['market'];
	        	$response[] = $tmp;
	        }
			$arr = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'total'=>$total,
					'items'=>$response
					)
				);
		}elseif($key == 'faxian'){
			$this->load->model('discovery_mdl','discovery');
			$list = array();
			$wherelist['order'] = array('key'=>'rank','value'=>'asc');
			$list = $this->discovery->getList($wherelist);
			$response = array();
			if(!empty($list)){
				foreach($list as $k => $v){
					$tmp['id'] = $v['id'];
					$tmp['name'] = $v['title'];
					$tmp['img'] = base_url().'uploads/discovery/'.$v['img'];
					$tmp['key'] = $v['d_key'];
					$response[] = $tmp;
				}
			}

			$arr = array(
				'errcode'=>0,
				'msg'=>'ok',
				'data'=>array(
					'total'=>count($response),
					'items'=>$response
					)
				);
		}else{
			$arr = array(
				'errcode'=>-1,
				'msg'=>'none',
				
				);
		}

		$this->responseData($arr);
	}
}