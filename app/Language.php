<?php

namespace App;

use function getArrLanguage;
use Illuminate\Database\Eloquent\Model;
use function in_array;
use const null;
use function session;
use function strtolower;
use function trim;

class Language extends Model
{
    protected $table = 'languages';

    static function getLang()
    {
        $l = session('language');
        return $l != null ? $l : 'km';
    }

    static function cleanKey($key)
    {
        $key = trim($key);
        $key = strtolower($key);
        return $key;
    }

    static function Translate($key)
    {
        $l = self::getLang();
        $lang = in_array($l,getArrLanguage())?$l:'km';

        $key = self::cleanKey($key);

        $m = self::where('key',$key)->first();

        if($m != null)
        {
            return $m->$lang != ''?$m->$lang:$key;
        }else{
            $m = new Language();
            $m->key = $key;
            $m->save();
            return $key;
        }

    }


}
