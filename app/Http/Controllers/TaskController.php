<?php

namespace App\Http\Controllers;

use Log;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    // タスク一覧を表示するアクション
    public function index() {
        $user = \Auth::user();
        // カラムadminが1の時(管理者権限)は全てのタスクを表示、それ以外は自分のタスクのみを表示
        if($user['admin'] == '1') {
            return Task::where('status',1)->get();
        } else {
            return Task::where('status',1)->where('user_id', $user['id'])->get();
        }
    }

    // タスクの詳細を表示するアクション
    public function show(Task $task) {
        return $task;
    }

    // タスクを投稿するアクション
    public function store(Request $request) {
        $data = $request->all();
        $user = \Auth::user();
        $validatedData = $request->validate([
            'title' => 'required|max:5',
            'content' => 'required',
            'person_in_change' => 'required',
        ]);

        $addUserIdData = ([
            'title' => $data['title'],
            'content' => $data['content'],
            'person_in_change' => $data['person_in_change'],
            'user_id' => $user['id'],
        ]);

        Task::create($addUserIdData);
        return ['message' => 'Task Created'];
    }

    // タスクを更新するアクション
    public function update(Request $request, Task $task) {
        $task->update($request->all());
        return $task;
    }

    // タスクを削除するアクション
    public function destroy(Request $request,Task $task) {
        //Log::warning('いいい'.$task);
        $task->where('id', $task->id)->update(['status' => 2]);
        return $task;
    }
}
