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


}
