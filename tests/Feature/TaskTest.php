<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_fetch_all_tasks_of_todo_list(): void
    {
        // Create a task using factory
        $task = Task::factory()->create();


        $response = $this->getJson(route("task.index"))->assertOk()->json();


        // $this->assertCount(1, $response);
        // $this->assertNotEmpty($response)

        $this->assertEquals(1,count($response));

        $this->assertEquals($task->title, $response[0]['title']);
    }
}
