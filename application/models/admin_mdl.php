<?php


class Admin_mdl extends Spring_Model
{
	
	var $table_name = 'spring_admin';

	public function __construct()
	{
		parent::__construct();
		//$this->set_table_name($this->table_name);
	}

	
}