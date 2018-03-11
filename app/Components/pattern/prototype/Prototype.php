<?php

namespace App\Components\pattern\prototype;

/**
 * 原型类
 * Class Prototype
 * @package App\Components\pattern\prototype
 */
abstract class Prototype{

    private $id;

    /**
     * @param $id
     */
    public function setId( $id){
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return mixed|static
     */
    public abstract function copy();

}