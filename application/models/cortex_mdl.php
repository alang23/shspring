<?php
/**
*@DEC皮质model
*
**/

class Cortex_mdl extends Spring_Model
{
	
	var $table_name = 'spring_cortex';

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
		$list = $this->db->get($this->table_name)->result_array();
		return $list;
	}

	
}