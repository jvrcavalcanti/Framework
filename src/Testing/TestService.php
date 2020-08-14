<?php

namespace Pendragon\Framework\Testing;

use Accolon\Request\Client;
use Accolon\Request\Enums\ContentType;
use PHPUnit\Framework\TestCase;

class TestService extends TestCase
{
    protected Client $client;

    public function setUp(): void
    {
        $this->client = new Client([
            'baseUrl' => env('APP_HOST') ?? "",
            'contentType' => ContentType::JSON
        ]);
    }
}
