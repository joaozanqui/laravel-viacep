<?php

namespace App\Http\Lib;

abstract class DataTransferObject
{
    public function __construct($data = [])
    {
        foreach ($data as $key=>$value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray()
    {
        return call_user_func('get_object_vars', $this);
    }
}
