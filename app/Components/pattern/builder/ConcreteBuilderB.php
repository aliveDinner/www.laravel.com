<?php

namespace App\Components\pattern\builder;

use App\Components\pattern\builder\Builder;
use App\Components\pattern\builder\Product;
/**
 * 产品A
 * Class ConcreteBuilderB
 * @package App\Components\pattern\builder
 */
class ConcreteBuilderB extends Builder
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
        $this->product->add('B的部件X');
    }

    /**
     * @return mixed
     */
    public function buildPartB(){
        $this->product->add('B的部件Y');
    }

    public function getResult(){
        return $this->product;
    }
}