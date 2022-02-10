<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;

class NoticeController extends Controller
{
    public function index() {
        return Notice::get()->all();
    }

    public function create() {

    }
}
