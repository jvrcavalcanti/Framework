<?php

namespace Pendragon\Framework\Traits;

trait Providers
{
    private array $providers = [];
    private array $services = [];

    public function registerProvider(string $class)
    {
        $provider = $this->make($class);
        $this->providers[] = $provider;
        $provider->register();

        return $this;
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->registerProvider($provider);
        }

        return $this;
    }

    public function bootProviders()
    {
        foreach ($this->providers as $provider) {
            $provider->boot();
        }
    }

    public function addService(string $name, $service)
    {
        if (is_object($service)) {
            $this->services[$name] = $service;
            return;
        }

        if (is_string($service)) {
            $this->services[$name] = $this->make($service);
            return;
        }

        if (is_callable($service)) {
            $this->services[$name] = call_user_func($service, $this);
            return;
        }
        
    }

    public function getService(string $name)
    {
        return $this->services[$name] ?? null;
    }
}
