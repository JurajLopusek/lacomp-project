<?php

namespace App\Filament\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ResourceEloquentQueryInterface
{
    /**
     * @param Builder<Model> $query
     * @return Builder<Model>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder;
}
