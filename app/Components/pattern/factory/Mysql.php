<?php

namespace App\Components\pattern\factory;

use App\Components\pattern\factory\IDataBase;

class Mysql implements IDataBase
{
    public function find(){
        return 'Mysql';
    }
}