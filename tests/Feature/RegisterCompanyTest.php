<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;
    public function test_company()
    {
        $data = [
            'name' => Str::random(20),
            'surname' => Str::random(20),
            'email' => $this->faker->safeEmail,
            'type' => 2,
            'password' => $this->faker->password(8),
            'status' => 1,
            'companyName' => $this->faker->name,
            'bin' => $this->faker->numerify,
        ];
        $response = $this->json('POST','/api/registerCompany',$data);
        $response->assertStatus(200);

    }
}
