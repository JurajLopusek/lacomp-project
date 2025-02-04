<?php

namespace App\Filament\Custom\Columns;

final class IdColumnEnhanced
{
    public static function factory(string $columnName = 'id', string $label = 'ID'): TextColumnEnhanced
    {
        return TextColumnEnhanced::make($columnName)
            ->label($label)
            ->prefix('#')
            ->setIdentificatorColumn()
            ->numeric();
    }
}
