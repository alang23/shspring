<?php
/**
*@DEC 街拍model
*
**/

class Fav_mdl extends Spring_Model
{

	var $table_name = 'spring_fav';
	var $table_product = 'spring_product';
	var $table_member = 'spring_member';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	public function get_list_by_join($config = array())
	{

		if(!empty($config['where'])){
            $this->db->where($config['where']);
        }

        if(!empty($config['page'])){
            $this->db->limit(intval($config['limit']));
            $this->db->offset(intval($config['offset']));
        }
		$list = array();
		$list = $this->db->select('
									pro.p_name,pro.id,pro.suk,pro.shop_id,pro.types,fav.id as favid,pro.pic,
									pro.brand_id,pro.category_id,pro.attr,pro.total,pro.price,pro.createtime,pro.enabled,m.username
									')
					->from($this->table_name.' as fav')
					->join($this->table_product.' as pro','pro.id=fav.pid','left')
					->join($this->table_member.' as m','m.id=fav.uid','left')
					->get()->result_array();

		return $list;
	}


	
}