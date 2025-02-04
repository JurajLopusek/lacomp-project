<?php

namespace App\Filament\Traits;

use Str;

trait SlugPageTrait
{
    public static function getSlug(): string
    {
        return str_replace('-page', '', Str::kebab(substr(static::class, strrpos(static::class, '\\') + 1)));
    }
}
