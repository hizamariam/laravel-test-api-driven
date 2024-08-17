<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    private $todoList;
    public function setUp(): void
    {
        parent::setUp();
        $this->todoList =$this->createTodoList();
    }

    public function test_fetch_todo_list(): void
    {
        // TodoList::factory()->count(3)->create();
        $response=$this->getJson(route("todo-list.index"));
        $this->assertEquals(1,count($response->json()));
    }

    public function test_fetch_single_todo_list(): void
    {
        //preparation
        $list=TodoList::factory()->create();

        //action
        $response=$this->getJson(route('todo-list.show',$list->id))->assertOk()->json();

        //assertion
        // $response->assertStatus(200);
        $this->assertEquals($response['name'],$list->name);
    }

    public function test_store_new_todo_list(): void
    {
        // Preparation - create a fake todo list data
        $listData = TodoList::factory()->raw(); // `raw` creates an array instead of persisting to the database

        // Action - send a POST request to store the todo list
        $response = $this->postJson(route('todo-list.store'), $listData)->assertStatus(201)->json();

        // Assertion - check if the todo list exists in the database with the provided name
        $this->assertDatabaseHas('todo_lists', ['name' => $listData['name']]);
    }

    public function test_while_storing_todo_list_is_required(): void
    {
        $this->withExceptionHandling();

        $this->postJson(route('todo-list.store'), [])->assertStatus(422)->assertJsonValidationErrors('name');
    }

    public function test_delete_todo_list(): void
    {
        $this->deleteJson(route('todo-list.destroy',$this->todoList->id))->assertNoContent();
        $this->assertDatabaseMissing('todo_lists', ['name'=>$this->todoList->name]);

    }

    public function test_update_todo_list(): void
    {
        $this->patchJson(route('todo-list.update',[$this->todoList->id]),['name'=>$this->todoList->name])->assertStatus(204);

        $this->assertDatabaseHas('todo_lists',['name'=>$this->todoList->name]);
    }

}
