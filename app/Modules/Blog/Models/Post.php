<?php

namespace App\Modules\Blog\Models;

use app\Helpers\GH;
use App\Traits\ActivityLogger;
use function getUserLevel;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use function json_encode;
use const null;

class Post extends Model
{
    use ActivityLogger;

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

    public function getStatusAttribute($status)
    {
        return getStatusTitle($status);
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
            $image = [];

            if($request->image_data2 != null && $id > 0)
            {
                $image = $request->image_data2;
            }
            //if($request->hasFile('image_data')) {
                $images = $request->image_data;
                if(count($images)>0) {

                    foreach ($images as $img) {
                        if($img != '') {
                            $filename = rand(11111, 99999) . '_' . time() . '_' . rand(1000, 5000) . '.png';
                            Image::make(file_get_contents($img))->save("upload/post/$filename");
                            $image[] = $filename;
                        }
                    }

                    if(count($image)>0) {
                        $m->image = $image;
                    }
                }
            //}

            $m->category_id = $request->category_id;
            $m->title = $request->title;
            $m->description = $request->description;

            $m->content = $request->content;
            $m->option = $request->option;
            $m->meta_title = $request->meta_title;
            $m->meta_description = $request->meta_description;
            $m->status = $request->status ==null?1:$request->status;
            $m->user_id = $request->user_id;

            if($m->save())
            {
                if($id>0 && $request->image_data2_remove != null)
                {
                    foreach ($request->image_data2_remove as $im)
                    {
                        GH::deleteFileUpload("upload/post/$im");
                    }
                }

                return $m;
            }else{
                return null;
            }

        }else{
            return null;
        }

    }

}
