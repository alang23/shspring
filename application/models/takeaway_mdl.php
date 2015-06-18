<?php
/**
*@DEC 自提地址model
*
**/

class Takeaway_mdl extends Spring_Model
{

	var $table_name = 'spring_take_away';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	
}