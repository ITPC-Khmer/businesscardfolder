<?php

namespace App\Modules\Ec\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSpec extends Model
{
    protected $table = 'item_specs';

    public static function getTitle($id)
    {
        $m = self::find($id);
        return $m == null?null:$m->title;
    }


    public static function saveData($request)
    {
        $id = $request->id;

        if($id>0)
        {
            $m = self::find($id);
        }else{
            $m = new ItemSpec();
        }

        $m->category_id = $request->category_id;
        $m->key = $request->key;
        $m->title = $request->title;

        $m->status = $request->status;
        $m->user_id = getUserID();

        if($m->save())
        {
            return $m;
        }else{
            return null;
        }

    }

    public static function getPaginate($request)
    {
        $m = self::orderBy('id','desc')->paginate(12);
        return $m;
    }


}
