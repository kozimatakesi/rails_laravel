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
        $oldData = $data['headers'];
        $caution = null;
        $user = \Auth::user();
        // 文頭に削除依頼があったタスクの場合コメントを付与
        if($data['data']['caution'] == '2') {
            $caution = '削除依頼のあったタスクを';
        }

        if($oldData == 'delete') {
            $comment = $caution.'削除しました';
        } else {
            $caution = $caution.'更新しました';
            $content = "<br>".
                'title: '.$oldData['title'].' > '.$data['data']['title']."<br>".
                'content: '.$oldData['content']. ' > '.$data['data']['content']."<br>".
                'person_in_change: '.$oldData['person_in_change']. ' > '.$data['data']['person_in_change'];
            $comment = $caution.$content;
        }
        $noticeData = ([
            'user_id' => $user['id'],
            'content_id' => $data['data']['id'],
            'notice' => $comment,
        ]);
        Notice::create($noticeData);
    }
}
