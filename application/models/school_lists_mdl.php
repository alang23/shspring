<?php


class School_lists_mdl extends Spring_Model
{
	
	var $table_name = 'spring_school_lists';
	var $table_school = 'spring_school';

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
		$list = $this->db->select('ls.id,ls.title,ls.author,ls.intro,ls.createtime,ls.img,ls.sid')
					->from($this->table_name.' as ls')
					->join($this->table_school.' as c','c.id=ls.sid','left')
					->get()->result_array();
		return $list;
	}

	
}