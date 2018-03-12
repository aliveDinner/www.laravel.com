<?php

namespace App\Components\pattern\builder;

/**
 * 建造者模式 产品类
 * Class Product
 * @package App\Components\pattern\builder
 */
class Product
{

    /**
     * 产品部件清单
     * @var array
     */
    public $list = [];

    /**
     * @param $part
     */
    public function add($part)
    {
        $this->list[] = $part;
    }

    /**
     * @return array
     */
    public function show()
    {
        return $this->list;
    }

}