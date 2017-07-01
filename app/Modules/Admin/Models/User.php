<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class User extends Model
{
    protected $table = 'users';

    protected $appends = ['role_name'];

    public function getRoleNameAttribute()
    {
        $role_id = $this->role_id;
        return $role_id>=0? self::arrRole()[$role_id]:'';
    }

    static function arrRole()
    {
        return [
            1 => 'User',
            2 => 'Admin',
            3 => 'Supper Admin'
        ];
    }

    static function getRoleOption($select = 0)
    {
        $op = '';
        foreach (self::arrRole() as $k=>$v)
        {
            $selected = $select == $k?'  selected="selected" ':'';
            $op .= '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
        }
        return $op;
    }

    static function getName($id)
    {
        $m = self::find($id);
        return $m != null?$m->name:'';
    }

    static function saveData($request)
    {
        $id = $request->id;
        $m = $id > 0? self::find($id): new User();

        if($request->hasFile('photo')) {
            $file = $request->file('photo');

            $extension = $file->getClientOriginalExtension();
            $filename = rand(11111, 99999) . '_' . time() .rand(1000, 5000). '.' . $extension;
            $file->move(public_path('upload/user'), $filename);

            $m->photo = $filename;
        }

        $m->role_id = $request->role_id;
        $m->name = $request->name;
        $m->phone = $request->phone;
        $m->status = $request->status;

        if($id >0 || strlen($request->password)>0)
        {
            $m->password = Hash::make($request->password);
        }

        $confirmation_code = str_random(30);

        if($id-0==0) {
            $m->username = $request->username;
            $m->email = $request->email;

            $m->confirmed = 0;
            $m->confirmation_code = $confirmation_code;
            $m->create_by = getUserID();
        }

        $m->update_by = getUserID();

        if($m->save())
        {
            if($id-0==0) {
                Mail::send('email.verify', $confirmation_code, function ($message) use ($request) {
                    $message->to($request->email, $request->username)
                        ->subject('Verify your email address');
                });
            }

            return $m;

        }else{
            return null;
        }

    }

    public static function getPaginate($request)
    {
        $m = self::orderBy('id','desc');

        if($request->q != null)
        {
            foreach ($request->q as $k=>$v) {
                $m->where(function ($query) use ($k,$v) {
                    $query->orWhere($k, 'like', "%{$v}%");
                });
            }
        }

        $rows = $m->paginate(6);

        if($request->q != null)
        {
            $rows->appends($request->q);
        }
        return $rows;

    }

}
