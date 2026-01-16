<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class OptionHelper
{
    public static function getOption(string $key, $default = null)
    {
        return \App\Models\Option::where('key', $key)->first()?->value ?? $default;
    }
}
