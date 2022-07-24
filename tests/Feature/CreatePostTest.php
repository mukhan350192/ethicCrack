<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use WithFaker;
    public function test_example()
    {
        $data = [
            'title' => $this->faker->text,
            'description' => $this->faker->text,
            'restrictions' => $this->faker->text,
            'token' => '335dc8e8fb27d09eeccbf1c3d978fea2e438fd94',
        ];
        $response = $this->json('POST','/api/createPost',$data);

        $response->assertStatus(200);
    }
}
