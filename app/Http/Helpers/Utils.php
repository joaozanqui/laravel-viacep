<?php

namespace App\Http\Helpers;

class Utils{
    public static function formatedDate($data){
        return date('d-m-Y', strtotime($data));
    }

    public static function setCustomMsg($type, $msg, $position = '')
    {
        session([
            'custom-msg' => ['type' => $type, 'msg' => $msg, 'position' => $position]
        ]);
    }

    public static function getCustomMsg()
    {
        $msg = session('custom-msg');

        session([
            'custom-msg' => []
        ]);

        if (!isset($msg) || count($msg) == 0)
            $msg = null;
            
        return $msg;
    }
}