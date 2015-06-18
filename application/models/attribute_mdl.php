<?php
/**
*@DEC 品牌属性model
*
**/

class Attribute_mdl extends Spring_Model
{

	var $table_name = 'spring_attribute';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

	
}