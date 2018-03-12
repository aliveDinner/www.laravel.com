<?php

namespace App\Components\pattern\factory;

use App\Components\pattern\factory\IDataBase;

class Oracle implements IDataBase
{
    public function find(){
        return 'Oracle';
    }
}