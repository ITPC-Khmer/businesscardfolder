<?php

Route::get('/photo/{template}/{filename}','ImageCController@getResponse');

Route::get('/n',function (){
    $m = \App\Modules\Member\Models\Member::get();
    //\Illuminate\Support\Facades\Notification::send($m,new \App\Notifications\PostNotification());
    \Illuminate\Support\Facades\Notification::send($m,new \App\Notifications\BlogPostMailNotification());
});