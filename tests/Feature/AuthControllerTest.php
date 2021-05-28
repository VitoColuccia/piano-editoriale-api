<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Throwable;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Throwable
     */
    public function test_login()
    {
        $response = $this->json('POST', '/api/v1/login', [
            'email' => 'admin@admin.it',
            'password' => 'password'
        ]);

        $response->assertOk()->assertJsonStructure([
            'data' => [
                'access_token',
                'type',
                'user' => [
                    'id',
                    'name',
                    'email'
                ]
            ]
        ]);

        $content = $response->decodeResponseJson();

        return $content['data']['access_token'];
    }

    /**
     * @depends test_login
     * @param string $access_token
     */
    public function test_get_user(string $access_token){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $access_token
        ])->json('GET', '/api/v1/users/1');

        $response->assertOk();
    }
}
