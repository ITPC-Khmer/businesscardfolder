<?php

function _t($txt)
{
    return \app\Helpers\GH::translate($txt);
}

function getArrLanguage()
{
   return [
       'en' => 'English',
       'km' => 'ខ្មែរ'
   ];

}

function getStatusOption($select)
{
    $op = '';
    foreach (\app\Helpers\GH::status() as $k=>$v)
    {
        $selected = $select == $k?'  selected="selected" ':'';
        $op .= '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
    }
    return $op;
}

function getStatusTitle($status)
{
    return $status>0?\app\Helpers\GH::status()[$status]:'';
}


function getMemberID()
{
    return \app\Helpers\GH::getMemberID();
}

function getMemberInfo()
{
    return \app\Helpers\GH::getMemberInfo();
}

function getUserID()
{
    return \app\Helpers\GH::getUserID();
}

function getUserInfo()
{
    return \app\Helpers\GH::getUserInfo();
}

function arrUserLevel()
{
    return \app\Helpers\GH::arrUserLevel();
}

function getUserLevel()
{
    return \app\Helpers\GH::getUserLevel();
}


function arrMemberLevel()
{
    return \app\Helpers\GH::arrMemberLevel();
}

function getMemberLevel()
{
    return \app\Helpers\GH::getMemberLevel();
}

