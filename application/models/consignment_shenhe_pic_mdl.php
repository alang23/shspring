<?php
/**
*@DEC 寄售审核图片model
*
**/

class Consignment_shenhe_pic_mdl extends Spring_Model
{

	var $table_name = 'spring_consignment_shenhe_pic';


	
	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	
}