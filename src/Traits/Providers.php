<?php

namespace Pendragon\Framework\Traits;

trait Providers
{
    private array $providers = [];
    private array $services = [];

    public function registerProvider(string $class)
    {
        $this->providers[] = $this->resolve($class);

        return $this;
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->registerProvider($provider);
        }

        return $this;
    }

    public function boot()
    {
        foreach ($this->providers as $provider) {
            $provider->boot();
        }
    }

    public function addService(string $name, $service)
    {
        $this->services[$name] = $service;
    }

    public function getService(string $name)
    {
        return $this->services[$name];
    }
}
