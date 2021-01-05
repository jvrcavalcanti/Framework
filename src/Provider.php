<?php

namespace Pendragon\Framework;

abstract class Provider
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        //
    }
}
