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
        Log::debug(print_r($data['headers'], true));
        $user = \Auth::user();
        if($data['data']['caution'] == '2') {
            $caution = '削除依頼のあったタスクを';
        } else {
            $caution = null;
        }

        if($data['headers'] == 'delete') {
            $comment = $caution.'削除しました';
        } else {
            $caution = $caution.'更新しました';
            $content = $data['headers']['title'];
            $comment = $caution.$content;
        }
        $noticeData = ([
            'user_id' => $user['id'],
            'content_id' => $data['data']['id'],
            'notice' => $comment.'から'.$data['data']['title'].'に変更しました',
        ]);
        Notice::create($noticeData);
    }
}
