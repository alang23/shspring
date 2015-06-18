<?php
/**
*@DEC 支付管理model
*
**/

class Filterwd_mdl extends Spring_Model
{

	var $table_name = 'spring_filterwd';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	
}