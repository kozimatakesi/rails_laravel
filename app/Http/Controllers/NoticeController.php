<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\Task;
use Log;

class NoticeController extends Controller
{
    public function index() {
        return Notice::latest('id')->get()->all();
    }

    public function store(Request $request,Task $task) {
        $data = $request->all();
        $user = \Auth::user();
        if($data['data']['caution'] == '2') {
            $caution = '削除依頼のあったタスクを';
        } else {
            $caution = null;
        }

        if($data['headers'] == 'edit') {
            $comment = $caution.'更新しました';
        } else {
            $comment = $caution.'削除しました';
        }
        $noticeData = ([
            'user_id' => $user['id'],
            'content_id' => $data['data']['id'],
            'notice' => $comment,
        ]);
        Notice::create($noticeData);
    }
}
