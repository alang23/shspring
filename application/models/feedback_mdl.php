<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-12-9
 * Time: 下午4:23
 */

class Feedback_mdl extends Spring_Model
{

    var $table_name = 'spring_feedback';
    var $table_member = 'spring_member';

    public function __construct()
    {
        parent::__construct();
    }

    //链表查询
    public function get_list_by_join($config = array())
    {
    	$list = array();
    	$list = $this->db->select('f.id,f.uid,f.content,f.respond,f.createtime,m.username')
    					->from($this->table_name.' as f')
    					->join($this->table_member.' as m','m.id=f.uid','left')
    					->get()->result_array();

    	return $list;

    }



}