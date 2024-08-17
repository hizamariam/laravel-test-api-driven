<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    public function index(){

        $lists=TodoList::all();
        // return response(['lists'=>[]]);
        return response()->json($lists);
    }

    public function show(TodoList $todoList)
    {
        return response($todoList);
    }
    public function store(TodoListRequest $request)
    {

        $todoList = TodoList::create($request->all());

        return response()->json($todoList, 201);
    }

    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }

    public function update(TodoListRequest $request, TodoList $todoList)
    {

        $todoList->update($request->all());
        return response('',Response::HTTP_NO_CONTENT);
    }
}
