<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\Task;
use Log;

class NoticeController extends Controller
{
    public function index() {
        return Notice::get()->all();
    }

    public function store(Request $request,Task $task) {
        Log::warning('ききき'.$request);
        $user = \Auth::user();
        $noticeData = ([
            'user_id' => $user['id'],
            'content_id' => $task['id'],
            'notice' => '整備中',
        ]);
        Notice::create($noticeData);
    }
}
