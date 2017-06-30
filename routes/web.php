<?php

Route::get('/photo/{template}/{filename}','ImageCController@getResponse');

Route::get('/n',function (){
    $m = \App\User::get();
    \Illuminate\Support\Facades\Notification::send($m,new \App\Notifications\PostNotification());
});