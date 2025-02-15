<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource("todo-list", TodoListController::class);

Route::get("task",[TaskController::class,"index"])->name("task.index");

// Route::get("todo-list",[TodoListController::class,"index"])->name("todo-list.index");
// Route::get("todo-list/{todoList}",[TodoListController::class,"show"])->name("todo-list.show");
// Route::post("todo-list/store",[TodoListController::class,"store"])->name("todo-list.store");
// Route::delete("todo-list/{todoList}/destroy",[TodoListController::class,"destroy"])->name("todo-list.destroy");
// Route::patch("todo-list/{todoList}/update",[TodoListController::class,"update"])->name("todo-list.update");
