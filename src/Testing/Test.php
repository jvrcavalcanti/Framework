<?php

namespace Pendragon\Framework\Testing;

use Accolon\Request\Client;
use Accolon\Request\Enums\ContentType;
use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'baseUrl' => env('APP_HOST') ?? "",
            'contentType' => ContentType::JSON
        ]);
        parent::__construct();
    }
}
