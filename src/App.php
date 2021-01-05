<?php

namespace Pendragon\Framework;

use Accolon\Container\Container;
use Accolon\Route\Router;
use Pendragon\Framework\Traits\HasProviders;

class App
{
    use HasProviders;

    private Router $router;
    private Container $container;

    public function __construct(?Container $container = null)
    {
        $this->router = new Router();
        $this->container = $container ?? new Container();
        $this->container->singletons(Container::class, $this->container);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }
}
