<?php
/**
*@DEC 街拍model
*
**/

class Taken_mdl extends Spring_Model
{

	var $table_name = 'spring_taken';
	var $table_member = 'spring_member';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	//链表查询
	public function get_list_by_join($config)
	{

		if(!empty($config['where'])){
			$this->db->where($config['where']);
		}

		if(!empty($config['page'])){
            $this->db->limit(intval($config['limit']));
            $this->db->offset(intval($config['offset']));
        }
		$list = array();
		$list = $this->db->select('t.id,t.title,t.img,t.total,t.uid,t.createtime,t.zan,m.username')
						->from($this->table_name.' as t')
						->join($this->table_member.' as m','m.id=t.uid','left')
						->get()->result_array();

		return $list;
	}

	
}