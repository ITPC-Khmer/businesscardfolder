<?php

namespace App\Modules\Ec\Models;

use function count;
use function getUserID;
use Illuminate\Database\Eloquent\Model;
use const null;

class ItemBrand extends Model
{
    protected $table = 'item_brands';

    public static function getBrandName($id)
    {
        $m = self::find($id);
        if($m != null)
        {
            return $m->brand_name;
        }else{
            return null;
        }

    }

    public static function getOption($select)
    {
        $op = '';
        $m = self::orderBy('brand_name','asc')->get();
        if(count($m)>0)
        {
            foreach ($m as $row)
            {
                $selected = $select == $row->id?' selected="selected" ':'';
                $op .= '<option '.$selected.' value="'.$row->id.'">'.$row->brand_name.'</option>';
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
            $m = new ItemBrand();
        }

        // save file
        $image = '#';
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(11111, 99999) . '_' . time() .rand(1000, 5000). '.' . $extension;
            $file->move(public_path('upload'), $filename);
            $image = $filename;
            $m->logo = $image;
        }

        // assign model
        $m->brand_name = $request->brand_name;

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
