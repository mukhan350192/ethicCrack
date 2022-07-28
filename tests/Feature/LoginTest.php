<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $data = [
            'email' => 'mukhan@i-credit.kz',
            'password' => '12345678',
        ];
        $response = $this->json('POST','/api/login',$data);


        $response->assertStatus(200);
    }
}
