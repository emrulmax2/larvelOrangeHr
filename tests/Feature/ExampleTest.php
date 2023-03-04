<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;
use App\Models\Todo;
use App\Models\Task;

use Illuminate\Support\Facades\Auth;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_login_page_response()
    {
        // To test the login routem
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    
    public function test_user_availablity() {

            // To test the 'users' table in the database has the following email 
            $this->assertDatabaseHas('users', [
                'email' => 'admin@admin.com'
            ]);
        
    }
    public function test_user_create() {

        $user = User::factory()->create();
        $hasUser = $user ? true : false;
        
        $this->assertTrue($hasUser);
    }
    public function test_todo_data_create() {
        
            //test todo for database
            $todo = Todo::factory()->create();
            $hasTodo = $todo ? true : false;
        
            $this->assertTrue($hasTodo);

    }
    public function test_todo_data_delete() {
        $task = Todo::factory()->create();
 
        $task->delete();
        
        $this->assertModelMissing($task);
    }

    public function test_task_data_create() {

            //test todo for database
            $todo = Task::factory()->create();
            $hasTodo = $todo ? true : false;
        
            $this->assertTrue($hasTodo);
    }

    public function test_task_data_delete() {
        $task = Task::factory()->create();
 
        $task->delete();
        
        $this->assertModelMissing($task);
    }



}
