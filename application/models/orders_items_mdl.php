<?php
/**
*@dec 款式Model
*
**/

class Orders_items_mdl extends Spring_Model
{
	
	var $table_name = 'spring_orders_items';
	var $table_orders = 'spring_orders';
	var $table_product = 'spring_product';

	public function __construct()
	{
		parent::__construct();

	}

	//链表
	public function get_list_by_join($config=array())
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
		$list = $this->db->select('oi.id,oi.order_id,oi.price,oi.p_name as p_name_o,oi.num,o.uid,p.pic,o.status')
					->from($this->table_name.' as oi')
					->join($this->table_orders.' as o','o.id=oi.order_id','left')
					->join($this->table_product.' as p','p.id=oi.pid')
					->get()->result_array();

		return $list;
	}

	//再次购买查询
	public function buy_again_list($config = array())
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
		$list = $this->db->select('oi.id,oi.pid,oi.num,oi.order_id,p.p_name,p.price,p.total,p.pic')
						->from($this->table_name.' as oi')
						->join($this->table_product.' as p','p.id=oi.pid','left')
						->get()->result_array();
		return $list;
	}


	
}