<?php
/**
*@DEC 搜索相关model
*
**/

class Search_mdl extends Spring_Model
{

	var $table_name = 'spring_search';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}

}