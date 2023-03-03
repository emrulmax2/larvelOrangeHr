<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        // To test the login routem
        $response = $this->get('/login');
        // To test the 'users' table in the database has the following email 
        $this->assertDatabaseHas('users', [
            'email' => 'admin@admin.com'
        ]);
        $response->assertStatus(200);
        // To test the database has users
        $user = User::factory()->create();
        $hasUser = $user ? true : false;

        $this->assertTrue($hasUser);
    }
}
