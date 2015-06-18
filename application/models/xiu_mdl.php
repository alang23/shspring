<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13-12-9
 * Time: 下午4:23
 */

class Xiu_mdl extends Spring_Model
{

    var $table_name = 'spring_xiu';
    //var $table_member = 'spring_xiu_pic';
    var $table_member = 'spring_member';

    public function __construct()
    {
        parent::__construct();
    }

    //链表查询
    public function get_one_by_join($config = array())
    {

        if(!empty($config['where'])){
            $this->db->where($config['where']);
        }

    	$list = array();
    	$list = $this->db->select('x.id,x.intro,x.createtime,m.username,m.photo')
    					->from($this->table_name.' as x')
    					->join($this->table_member.' as m','m.id=x.uid','left')
    					->get()->row_array();

    	return $list;

    }



}