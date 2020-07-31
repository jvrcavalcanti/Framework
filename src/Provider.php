<?php

namespace Pendragon\Framework;

use Pendragon\Framework\App;

abstract class Provider
{
    private App $app;

    public function __construct()
    {
        $this->app = app();
    }

    public function boot()
    {
        //
    }

    public function register()
    {
        //
    }
}
