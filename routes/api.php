<?php

use Illuminate\Http\Request;

// タスクリスト表示
Route::get('/tasks', 'TaskController@index');
// タスク投稿
Route::post('/tasks', 'TaskController@store');
// タスク詳細表示
Route::get('/tasks/{task}', 'TaskController@show');
// タスク更新
Route::put('/tasks/{task}', 'TaskController@update');
// 管理者のみ　タスク削除依頼
Route::put('/tasks/{task}/caution', 'TaskController@caution');
// タスク削除(statusを2に変更する、データベースには残る仕様)
Route::delete('/tasks/{task}/', 'TaskController@destroy');
// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');
// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');
// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/user', fn() => Auth::user())->name('user');

// 管理者のみ　お知らせ表示
Route::get('/notices', 'NoticeController@index');
// お知らせ作成
Route::post('/notices/{task}', 'NoticeController@store');
