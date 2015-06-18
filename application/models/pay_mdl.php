<?php
/**
*@DEC 支付管理model
*
**/

class Pay_mdl extends Spring_Model
{

	var $table_name = 'spring_pay';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	
}