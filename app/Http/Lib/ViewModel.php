<?php

namespace App\Http\Lib;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

abstract class ViewModel implements Arrayable
{
    public function __get($name): ?string
    {
        $name = Str::camel($name);

        $values = $this->{$name}();

        if (! is_string($values)) {
            return json_encode($values);
        }

        return $values;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
