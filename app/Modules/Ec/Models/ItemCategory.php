<?php

namespace App\Modules\Ec\Models;

use function count;
use Illuminate\Database\Eloquent\Model;
use const null;
use function str_repeat;

class ItemCategory extends Model
{
    protected $table = 'item_categories';

    public static function getTitle($id)
    {
        $m = self::find($id);
        return $m == null?null:$m->title;
    }

    public static function getOption($select=null,$parent=0,$level=0)
    {
        $op = '';
        $rows = self::where('parent',$parent)->get();
        if(count($rows)>0)
        {
            foreach ($rows as $row)
            {
                $rows2 = self::where('parent',$row->id)->get();

                $selected = $select == $row->id?' selected="selected" ':'';
                if(count($rows2)>0)
                {
                    $op .= '<option '.$selected.' value="'.$row->id.'">'.str_repeat('&nbsp;',$level).$row->title.'</option>';

                    $op .= self::getOption($select,$row->id,$level+3);
                }else{
                    $op .= '<option '.$selected.' value="'.$row->id.'">'.str_repeat('&nbsp;',$level).$row->title.'</option>';
                }

            }
        }

        return $op;


    }

    public static function saveData($request)
    {
        $id = $request->id;
        if($id>0)
        {
            $m = self::find($id);
        }else{
            $m = new ItemCategory();
        }

        // save file
        $image = '#';
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(11111, 99999) . '_' . time() .rand(1000, 5000). '.' . $extension;
            $file->move(public_path('upload'), $filename);
            $image = $filename;
            $m->image = $image;
        }

        $m->parent = $request->parent;
        $m->title = $request->title;
        $m->description = $request->description;

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
