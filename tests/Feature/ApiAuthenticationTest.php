<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiAuthenticationTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_api_v1_resources_require_authentication(): void
    {
        $this->getJson('/api/v1/pelanggan')->assertUnauthorized();
    }
}
