<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Taskstest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAUserCreateTasks()
    {
//        $this->withhoutExceptionHandling();

        $this->actingAs($user = User::factory()->create());

        $attributes = Task::factory()->raw(['owner_id' => $user]);
        $this->post('/tasks', $attributes);

        $this->assertDatabaseHas('tasks', $attributes);
    }

}

