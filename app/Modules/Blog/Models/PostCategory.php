<?php

namespace App\Modules\Blog\Models;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';

    public static function getTitle($id)
    {
        $m = self::find($id);
        if($m != null)
        {
            return $m->title;
        }else{ return '';}

    }

    public static function getOption($select=null,$parent=0,$level=0)
    {
        $rows = self::where('parent',$parent)->get();
        $op = '';
        if(count($rows)>0)
        {
            foreach ($rows as $row){
                $rows2 = self::where('parent',$row->id)->get();

                if(is_array($select))
                {
                    $selected = in_array($row->id,$select)?' selected="selected" ':'';
                }else{
                    $selected = $row->id==$select?' selected="selected" ':'';
                }

                if(count($rows2)>0)
                {
                    $op .= '<option disabled="disabled" '.$selected.' value="'.$row->id.'">'.str_repeat('&nbsp;',$level).$row->title.'</option>';
                    $op .= self::getOption($select,$row->id,$level+3);
                }else{
                    $op .= '<option '.$selected.' value="'.$row->id.'">'.str_repeat('&nbsp;',$level).$row->title.'</option>';
                }
            }
        }
        return $op;

    }

}
