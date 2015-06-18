<?php
/**
*@dec颜色api
*@tags color
**/

class Color extends Api_Controller
{
	

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data = $this->requestData();
		$this->load->model('color_mdl','color');
		$this->load->model('color_relation_mdl','color_relation');
		$where['where'] = array('cr.tags'=>'color');
		/*
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
		$color = $this->color->getList();
		
		$items = array();
		if(!empty($color)){
			foreach($color as $k => $v){
				$tmp2['id'] = $v['id'];
				$tmp2['title'] = $v['title'];
				$tmp2['img'] = base_url().'uploads/appcolor/'.$v['img'];
				$tmp2['color'] = isset($colorarr[$v['id']]) ? $colorarr[$v['id']] : array();
				$items[] = $tmp2;
			}
		}
		*/
		//颜色种类
		$types = array();
		$color = array();
		$color = $this->color->getList();
		if(count($color) > 0){
			foreach($color as $k => $v){
				$tmp2['id'] = $v['id'];
				$tmp2['title'] = $v['title'];
				$tmp2['img'] = base_url().'uploads/appcolor/'.$v['img'];
				$types[] = $tmp2;
			}
		}

		//颜色属性值
		$where['where'] = array('cr.tags'=>'color');
		$list = $this->color_relation->get_list_join($where);
		$colorarr = array();
		if(!empty($list)){
			foreach($list as $k => $v){
				$tmp['id'] = $v['id'];
				$tmp['typeid'] = $v['color_id'];
				$tmp['name'] = $v['attr_name'];
				$tmp['img'] = base_url().'uploads/attribute/'.$v['attr_pic'];
				$colorarr[] = $tmp;
			}
		}


		$responseData = array(
			'tag'=>$data['tag'],
			'errcode'=>0,
			'msg'=>'ok',
			'data'=>array(
				'color_type'=>$types,
				'color_value'=>$colorarr
				)
			);
	
		$this->responseData($responseData);

	}


}