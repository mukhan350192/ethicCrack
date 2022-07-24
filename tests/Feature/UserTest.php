<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;
    public function test_can_register()
    {

        $data = [
            'name' => Str::random(20),
            'surname' => Str::random(20),
            'email' => $this->faker->safeEmail,
            'type' => 1,
            'password' => $this->faker->password(8),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
        $response = $this->json('POST','/api/register',$data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users',[
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'type' => $data['type'],
            'status' => $data['status'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
        //'password' => $data['password'],
    }
}
