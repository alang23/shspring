<?php
/**
*@DEC 街拍model
*
**/

class Cart_mdl extends Spring_Model
{

	var $table_name = 'spring_cart';
	var $table_product = 'spring_product';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	public function get_list_by_join($config=array())
	{

		if(!empty($config['where'])){
            $this->db->where($config['where']);
        }

        if(!empty($config['page'])){
            $this->db->limit(intval($config['limit']));
            $this->db->offset(intval($config['offset']));
        }

		$list = array();
		$list = $this->db->select('p.id,p.p_name,p.pic,p.price,p.total,p.total,c.id as cart_id,c.pid,c.num,c.uid,c.enabled,c.uid')
						->from($this->table_name.' as c')
						->join($this->table_product.' as p','c.pid=p.id','left')
						->get()->result_array();
		return $list;
	}



	
}