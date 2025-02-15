<?php

namespace App\Filament\Custom\Columns\Relations;

use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Models\Device;
use Illuminate\Support\Str;

class UserColumnEnhanced
{
    public const REPLACE_CHAR = '(';

    public static function factory(string $relation = 'user', ?string $label = 'Používateľ', string $table = 'users'): TextColumnEnhanced
    {
        return TextColumnEnhanced::make(sprintf('%s.%s', $relation, 'filament_label'))
            ->setHiddenInRelationManager(new Device())
            ->formatStateUsing(fn (string $state): string => Str::replace(self::REPLACE_CHAR, '<br>(', $state))
            ->html()
            ->setWhereClauseAttribute(sprintf('CONCAT_WS(" ", %1$s.id, %1$s.name, %1$s.email)', $table))
            ->setSortClauseAttribute("{$table}.id")
            ->label($label);
    }
}
