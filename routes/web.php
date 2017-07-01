<?php

Route::get('/photo/{template}/{filename}','ImageCController@getResponse');

Route::get('register/verify/{confirmationCode}', function ($confirmationCode){

    $user = \App\Modules\Admin\Models\User::where('confirmation_code',$confirmationCode)->first();

    if($user != null) {
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        //Flash::message('You have successfully verified your account.');

        return redirect('admin/login');
    }else{
        return 'error!!';
    }

});

Route::get('/n',function (){
    $m = \App\Modules\Member\Models\Member::get();
    //\Illuminate\Support\Facades\Notification::send($m,new \App\Notifications\PostNotification());
    \Illuminate\Support\Facades\Notification::send($m,new \App\Notifications\BlogPostMailNotification());
});