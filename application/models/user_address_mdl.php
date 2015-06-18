<?php
/**
*@dec 用户收货地址model
*
**/

class User_address_mdl extends Spring_Model
{
	
	var $table_name = 'spring_user_address';
	var $table_region     = 'spring_region';

	public function __construct()
	{
		parent::__construct();
		
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

        if(!empty($config['order'])){
        	$this->db->order_by($config['order']['key'],$config['order']['value']);
        }
		$list = array();
		$list = $this->db->select('ar.id,ar.realname,ar.zip_code,ar.mobile,ar.province_id,ar.city_id,ar.area_id,ar.address,ar.default,re.region_name as n1,re2.region_name as n2,re3.region_name as n3')
						->from($this->table_name.' as ar')
						->join($this->table_region.' as re','ar.province_id=re.region_id','left')
						->join($this->table_region.' as re2','ar.city_id=re2.region_id','left')
						->join($this->table_region.' as re3','ar.area_id=re3.region_id','left')
						->get()->result_array();

		return $list;
	}

	
}