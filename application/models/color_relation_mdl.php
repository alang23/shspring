<?php
/**
*@DEC颜色分类model
*
**/

class Color_relation_mdl extends Spring_Model
{
	
	var $table_name = 'spring_color_relation';
	var $table_attr = 'spring_attribute_content';


	public function __construct()
	{
		parent::__construct();

	}

	public function get_list_join($config = array())
	{

		if(!empty($config['where'])){
            $this->db->where($config['where']);
        }

        if(!empty($config['page'])){
            $this->db->limit(intval($config['limit']));
            $this->db->offset(intval($config['offset']));
        }

        if(!empty($config['order'])){
        	$this->db->order_by($config['order']['key'],$config['order']['value']);
        }

		$list = array();
		$list = $this->db->select('cr.id,cr.tags,cr.color_id,attr.attr_name,attr.attr_pic')
					->from($this->table_name.' as cr')
					->join($this->table_attr.' as attr','cr.attr_id=attr.id','left')
					->get()->result_array();		

		return $list;
	}
	
}