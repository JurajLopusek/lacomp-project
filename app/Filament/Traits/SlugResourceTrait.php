<?php

namespace App\Filament\Traits;

use Str;

trait SlugResourceTrait
{
    public static function getSlug(): string
    {
        return str_replace('-resource', '', Str::kebab(substr(static::class, strrpos(static::class, '\\') + 1)));
    }
}
