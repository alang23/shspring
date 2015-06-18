<?php


class Attribute_content_mdl extends Spring_Model
{

	var $table_name = 'spring_attribute_content';
	var $table_name_attribute = 'spring_attribute';
	

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	//关联属性表查询
	public function get_one_join_attribute($config)
	{
		if(!empty($config)){
			$this->db->where($config);
		}
		$info = array();
		$info = $this->db->select('attr.name,attr.typeid,attrv.id,attrv.attr_name,attrv.attr_value,attrv.attr_intro,attrv.attr_pic,attrv.shop_id,attrv.attr_id')
					->from($this->table_name.' as attrv')
					->join($this->table_name_attribute.' as attr','attrv.attr_id = attr.id','left')
					->get()->row_array();
		return $info;
	}


	
}