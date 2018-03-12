<?php

namespace App\Components\pattern\builder;

use App\Components\pattern\builder\Builder;

/**
 * 建造者模式 指挥者类
 * Class Director
 * @package App\Components\pattern\builder
 */
class Director
{

    /**
     * 用来指挥建造过程
     * @param \App\Components\pattern\builder\Builder $builder
     * @return mixed
     */
    public function construct(Builder $builder)
    {
        $builder->buildPartA();
        $builder->buildPartB();
    }

}