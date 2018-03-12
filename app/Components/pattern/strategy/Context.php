<?php

namespace App\Components\pattern\strategy;

/**
 * Class Strategy
 * @package App\Components\pattern\strategy
 */
class Context{

    /**
     * @var \App\Components\pattern\strategy\Strategy
     */
    public $strategy;

    /**
     *
     * Context constructor.
     * @param Strategy $strategy
     */
    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     *
     */
    public function contextInterface()
    {
        return $this->strategy->algorihm();
    }
}