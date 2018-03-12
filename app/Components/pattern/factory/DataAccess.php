<?php

namespace App\Components\pattern\factory;

use App\Components\pattern\factory\Config;

/**
 * Class DataAccess
 * @package App\Components\pattern\factory
 */
class DataAccess
{

    /**
     * @var null|\App\Components\pattern\factory\IDataBase
     */
    public $db = null;

    /**
     * @return mixed
     */
    public function find(){
        if ($this->db == null){
            $db = Config::get()['db'];
            $this->db = new $db();
        }
        return $this->db->find();
    }
}