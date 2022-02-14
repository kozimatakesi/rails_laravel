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
        $tasks = new Task;
        $user = \Auth::user();
        // カラムadminが1の時(管理者権限)は全てのタスクを表示、それ以外は自分のタスクのみを表示
        if($user['admin'] == '1') {
            $return = $tasks->getAllTasks();
            return $return;
            // return Task::where('status',1)->latest('id')->get();
        } else {
            return Task::where('status',1)->where('user_id', $user['id'])->latest('id')->get();
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
        $data = $request->all();
        $validatedData = $request->validate([
            'title' => 'required|max:5',
            'content' => 'required',
            'person_in_change' => 'required',
            'caution' => 'required',
        ]);
        $changeCautionData = ([
            'title' => $data['title'],
            'content' => $data['content'],
            'person_in_change' => $data['person_in_change'],
            'caution' => 1,
        ]);
        Log::debug(print_r($changeCautionData, true));
        $task->update($changeCautionData);
        return $task;
    }

    // タスクを削除するアクション
    public function destroy(Request $request,Task $task) {
        //Log::warning('いいい'.$task);
        $task->where('id', $task->id)->update(['status' => 2]);
        return $task;
    }

    // 管理者権限のみ タスクに削除依頼をするアクション
    public function caution(Request $request,Task $task) {
        $task->where('id', $task->id)->update(['caution' => 2]);
    }
}
