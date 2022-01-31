<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index() {
        return Task::all();
    }

    public function show(Task $task) {
        return $task;
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|max:5',
            'content' => 'required',
            'person_in_change' => 'required'
        ]);

        Task::create($validatedData);

        return ['message' => 'Task Created'];
    }

    public function update(Request $request, Task $task) {
        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task) {
        $task->delete();
        return $task;
    }
}
