<?php



// Route::post('/login/guest',
//     'Auth\LoginController@guestLogin')->name('guest_login');

Route::get('/{any}', function() {
    return view('layouts.app');
})->where('any', '.*');
