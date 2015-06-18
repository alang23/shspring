<?php
/**
*@DEC 品牌属性model
*
**/

class Product_mdl extends Spring_Model
{

	var $table_name = 'spring_product';
	var $table_brand = 'spring_brand';
	var $table_category = 'spring_category';
	var $table_fav = 'spring_fav';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
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


		$list = array();
		$list = $this->db->select('
									pro.p_name,pro.id,pro.suk,pro.shop_id,pro.types,pro.market,pro.discount,pro.pic,
									pro.brand_id,pro.category_id,pro.attr,pro.total,pro.price,pro.createtime,pro.enabled,
									brand.b_name,category.c_name
									')
					->from($this->table_name.' as pro')
					->join($this->table_brand.' as brand','brand.id=pro.brand_id','left')
					->join($this->table_category.' as category','category.id=pro.category_id','left')
					->get()->result_array();

		return $list;
	}



	//商品详情
	public function get_one_by_join($where)
	{

		$info = array();
        if(!empty($where)){
            $this->db->where($where);
        }

        $info = $this->db->select('pro.*,c.c_name,b.b_name')
        				->from($this->table_name.' as pro')
        				->join($this->table_brand.' as b','b.id=pro.brand_id','left')
        				->join($this->table_category.' as c','c.id=pro.category_id','left')
        				
        				->get()->row_array();

        return $info;
	}

	
	
}