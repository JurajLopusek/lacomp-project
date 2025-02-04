<?php

namespace App\Filament\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface ResourceEloquentQueryInterface
{
    public static function getResourceEloquentQuery(Builder $query): Builder;
}
