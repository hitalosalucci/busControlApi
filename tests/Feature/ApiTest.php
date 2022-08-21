<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{

    public function test_api_ok()
    {
        $response = $this->get('/api/ping');
        $response->assertStatus(200);
    }

    public function test_return_api_ok()
    {
        $response = $this->get('/api/ping');
        $response->assertSimilarJson([
            "ping" => true
        ]);
    }
}
