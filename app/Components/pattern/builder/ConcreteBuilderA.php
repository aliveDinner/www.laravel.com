<?php

namespace App\Components\pattern\builder;

use App\Components\pattern\builder\Builder;
use App\Components\pattern\builder\Product;
/**
 * 产品A
 * Class ConcreteBuilderA
 * @package App\Components\pattern\builder
 */
class ConcreteBuilderA extends Builder
{

    /**
     * @var null|\App\Components\pattern\builder\Product
     */
    private $product = null;

    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * @return mixed
     */
    public function buildPartA(){
        $this->product->add('A的部件A');
    }

    /**
     * @return mixed
     */
    public function buildPartB(){
        $this->product->add('A的部件B');
    }

    public function getResult(){
        return $this->product;
    }
}