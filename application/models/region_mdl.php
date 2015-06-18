<?php

/**
 * 省市区类
 */
class region_mdl extends  Spring_Model
{ 
    var $table_name = 'spring_region';
 
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 删除所有
     * @return [type] [description]
     */
    public function delall(){ 
        return $this->db-> truncate(self::TABLE);
    }


}