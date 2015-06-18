<?php
/**
*@dec 款式Model
*
**/

class Fedex_address_mdl extends Spring_Model
{
	
	var $table_name = 'spring_fedex_address';
	var $table_category = 'spring_region';

	public function __construct()
	{
		parent::__construct();

	}

	public function get_list_by_join($config)
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
		$list = $this->db->select('c.c_name,s.img,s.id,s.rank')
					->from($this->table_name.' as s')
					->join($this->table_category.' as c','c.id=s.category_id','left')
					->get()->result_array();
		return $list;
	}

	
}