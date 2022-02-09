<?php

// どこにアクセスしても layouts/app.blade.php にアクセスさせるルーティング
Route::get('/{any}', function() {
    return view('layouts.app');
})->where('any', '.*');
