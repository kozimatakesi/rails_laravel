<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetsController extends Controller
{
    public function index()
    {
        $tweets = Tweet::get();
        return view('tweets/index', compact('tweets'));
    }
}
