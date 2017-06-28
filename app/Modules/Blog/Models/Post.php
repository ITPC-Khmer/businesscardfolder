<?php

namespace App\Modules\Blog\Models;

use function getUserLevel;
use Illuminate\Database\Eloquent\Model;
use function json_encode;
use const null;

class Post extends Model
{
    protected $table = 'posts';

    protected $appends = ['category_name'];

    public function getCategoryNameAttribute()
    {
        return PostCategory::getTitle($this->category_id);
    }

    public static function getTitle($id)
    {
        $m = self::find($id);
        if($m != null)
        {
            return $m->title;
        }else{ return '';}

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

    public function getImageAttribute($image)
    {
        return json_decode($image);
    }

    public function getStatusAttribute($att)
    {
        return $att>0?'Active':'Inactive';
    }


    public function setImageAttribute($value)
    {
        $this->attributes['image'] = json_encode($value);
    }

    public function getOptionAttribute($option)
    {
        return json_decode($option);
    }

    public function setOptionAttribute($value)
    {
        $this->attributes['option'] = json_encode($value);
    }

    public static function saveData($request)
    {
        if(getUserLevel()>0)
        {
            $id = $request->id;
            if($id>0)
            {
                $m = self::find($id);
            }else{
                $m = new Post();
            }


            $image = $request->image;

            if($request->hasFile('r_image')) {
                $files = $request->file('r_image');
                foreach ($files as $k=>$file)
                {
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(11111, 99999) . '_' . time() .rand(1000, 5000). '.' . $extension;
                    $file->move(public_path('upload/post'), $filename);
                    $image[$k]['image'] = $filename;
                }
            }

            $m->category_id = $request->category_id;
            $m->title = $request->title;
            $m->description = $request->description;
            $m->image = $image;
            $m->content = $request->content;
            $m->option = $request->option;
            $m->meta_title = $request->meta_title;
            $m->meta_description = $request->meta_description;
            $m->status = $request->status;
            $m->user_id = $request->user_id;

            if($m->save())
            {
                return $m;
            }else{
                return null;
            }

        }else{
            return null;
        }

    }

}
