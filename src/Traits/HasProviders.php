<?php

namespace Pendragon\Framework\Traits;

trait HasProviders
{
    /** @property Provider[] */
    private array $providers = [];

    public function registerProvider(string $class)
    {
        $provider = $this->container->make($class);
        $provider->register();
        $this->providers[] = $provider;
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            $this->registerProvider($provider);
        }
    }

    public function bootProviders()
    {
        foreach ($this->providers as $provider) {
            $provider->boot();
        }
    }
}
