<?php
namespace app\Helpers;

use App\Language;
use Illuminate\Database\Eloquent\Model;

class GH extends Model
{
    public static function arrMemberLevel()
    {
        return [1=>'Bronze Level Membership',2=>'Silver Level Membership',3=>'Gold Level Membership',4=>'Platinum Level Membership'];
    }

    public static function getMemberLevel()
    {
        return 3;
        try {
            $m_level = session('m_level');
            return $m_level - 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function getMemberID()
    {
        try {
            $member_id = session('m_id');
            return $member_id - 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function getMemberInfo()
    {
        try {
            return [
                'id' => session('m_id'),
                'name' => session('m_name'),
                'email' => session('m_email'),
                'phone' => session('m_phone')
            ];
        } catch (\Exception $e) {

            return [
                'id' => 0,
                'name' => '',
                'email' => '',
                'phone' => ''
            ];
        }
    }

    public static function getUserID()
    {
        try {
            $user_id = session('u_id');
            return $user_id - 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function getUserInfo()
    {
        try {
            return [
                'id' => session('u_id'),
                'name' => session('u_name'),
                'email' => session('u_email'),
                'phone' => session('u_phone')
            ];
        } catch (\Exception $e) {

            return [
                'id' => 0,
                'name' => '',
                'email' => '',
                'phone' => ''
            ];
        }
    }

    public static function arrUserLevel()
    {
        return [1=>'User',2=>'Admin',3=>'Supper Admin'];
    }

    public static function getUserLevel()
    {
        return 3;
        try {
            $u_level = session('u_level');
            return $u_level - 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function status(){
        return [0=> 'Disable',1=> 'Enabled'];
    }

    static function translate($txt)
    {
        return Language::Translate($txt);
        //return $txt;
    }

}