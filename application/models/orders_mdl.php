<?php
/**
*@dec 款式Model
*
**/

class Orders_mdl extends Spring_Model
{
	
	var $table_name = 'spring_orders';
	var $table_member = 'spring_member';

	public function __construct()
	{
		parent::__construct();

	}

	//链表查询
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
		$list = $this->db->select('o.id,o.no,o.uid,o.address,o.status,o.exp,m.username,o.invoice,m.phone')
						->from($this->table_name.' as o')
						->join($this->table_member.' as m','o.uid=m.id','left')
						->get()->result_array();

		return $list;
	}


	
}