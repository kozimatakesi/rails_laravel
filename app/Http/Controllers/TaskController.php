<?php

namespace App\Http\Controllers;

use Log;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index() {
        $user = \Auth::user();
        if($user['admin'] == '1') {
            return Task::where('status',1)->get();
        } else {
            return Task::where('status',1)->where('user_id', $user['id'])->get();
        }
    }

    public function show(Task $task) {
        return $task;
    }

    public function store(Request $request) {

        // $validatedData = $request->validate([
        //     'title' => 'required|max:5',
        //     'content' => 'required',
        //     'person_in_change' => 'required',
        //     'user_id' => 'required'
        // ]);
        //Task::create($validatedData);
        //return ['message' => 'Task Created'];
        $data = $request->all();
        $user = \Auth::user();
        Task::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'person_in_change' => $data['person_in_change'],
            'user_id' => $user['id'],
        ]);

        return ['message' => 'Task Created'];
    }

    public function update(Request $request, Task $task) {
        $task->update($request->all());
        return $task;
    }

    public function destroy(Request $request,Task $task) {
        //Log::warning('いいい'.$task);
        $task->where('id', $task->id)->update(['status' => 2]);
         //$task->delete();
        return $task;
    }
}
