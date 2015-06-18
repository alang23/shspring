<?php
/**
*@dec皮质api
*@tags color
**/

class Cortex extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();
		$this->load->model('cortex_mdl','cortex');
		$this->load->model('color_relation_mdl','color_relation');
		$where['where'] = array('cr.tags'=>'cortex');
		$list = $this->color_relation->get_list_join($where);
	
		$colorarr = array();
		if(!empty($list)){
			foreach($list as $k => $v){
				$tmp['id'] = $v['id'];
				$tmp['name'] = $v['attr_name'];
				$tmp['img'] = base_url().'uploads/attribute/'.$v['attr_pic'];
				$colorarr[$v['color_id']][] = $tmp;
			}
		}
				
		$color = array();
		$color = $this->cortex->getList();
		
		$items = array();
		if(!empty($color)){
			foreach($color as $k => $v){
				$tmp2['id'] = $v['id'];
				$tmp2['title'] = $v['title'];
				$tmp2['cortex'] = isset($colorarr[$v['id']]) ? $colorarr[$v['id']] : array();
				$items[] = $tmp2;
			}
		}

		
		
		$responseData = array(
			'tag'=>$data['tag'],
			'errcode'=>0,
			'msg'=>'ok',
			'data'=>array(
				'items'=>$items
				)
			);
		
		 $this->responseData($responseData);

	}


}