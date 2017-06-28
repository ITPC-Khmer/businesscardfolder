<?php

namespace App\Modules\Ec\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

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
            $m = new Item();
        }

        // save file
        $images = [];
        if($request->hasFile('images')) {

            $files = $request->file('images');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = rand(11111, 99999) . '_' . time() . rand(1000, 5000) . '.' . $extension;
                $file->move(public_path('upload'), $filename);
                $images[] = $filename;
            }
            $m->image = json_encode($images);
        }

        $m->category_id = $request->category_id;
        $m->member_id = getMemberID();
        $m->brand_id = $request->brand_id;
        $m->code = $request->code;
        $m->barcode = $request->barcode;
        $m->title = $request->title;
        $m->description = $request->description;
        $m->start_price = $request->start_price;
        $m->promotion_price = $request->promotion_price;
        $m->promotion_expire = $request->promotion_expire;
        $m->private_price = $request->private_price;
        $m->condition = $request->condition;
        $m->condition_description = $request->condition_description;
        $m->return_policy = $request->return_policy;
        $m->option = json_encode($request->option);

        $m->status = $request->status;
        $m->user_id = getUserID();

        if($m->save())
        {

            $specs = $request->specs;
            if(count($specs)>0)
            {
                foreach ($specs as $spec)
                {
                    $md = new  ItemSpecDetail();


                }
            }


        }else{
            return null;
        }


    }


}
