<?php

namespace App\Filament\Traits;

use App\Filament\Custom\Columns\TextColumnEnhanced;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Schema;

trait CommonColumnsTrait
{
    /**
     * @param Table $table
     * @param bool $hideCommonColumns
     * @return array<TextColumn|TextColumnEnhanced>
     */
    protected static function getCommonColumns(Table $table, bool $hideCommonColumns = true): array
    {
        $modelTable = (new ($table->getModel()))->getTable();

        $columns = [
            TextColumn::make('creator.name')
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('creator', function ($query) use ($search) {
                        return $query->vyhladavanieObsahujuce($search);  // FIXME change
                    });
                }, isIndividual: true, isGlobal: false)
                ->label('Vytvoril')
                ->extraAttributes(['style' => 'min-width:140px;'], true)
                ->toggleable()
                ->toggledHiddenByDefault($hideCommonColumns),
            TextColumn::make('updater.name')
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('updater', function ($query) use ($search) {
                        return $query->vyhladavanieObsahujuce($search);  // FIXME change
                    });
                }, isIndividual: true, isGlobal: false)
                ->label('Upravil')
                ->extraAttributes(['style' => 'min-width:140px;'], true)
                ->toggleable()
                ->toggledHiddenByDefault($hideCommonColumns),
            TextColumnEnhanced::make('created_at')
                ->setWhereClauseAttribute($modelTable . '.created_at')
                ->label('Vytvorené')
                ->date()
                ->toggleable()
                ->toggledHiddenByDefault($hideCommonColumns),
            TextColumnEnhanced::make('updated_at')
                ->setWhereClauseAttribute($modelTable . '.updated_at')
                ->label('Upravené')
                ->date()
                ->toggleable()
                ->toggledHiddenByDefault($hideCommonColumns),

        ];

        if (Schema::hasColumn($modelTable, 'deleted_at')) {
            $columns[] = TextColumnEnhanced::make('deleted_at')
                ->setWhereClauseAttribute($modelTable . '.deleted_at')
                ->label('Odstránené')
                ->date()
                ->toggleable()
                ->toggledHiddenByDefault($hideCommonColumns);
        }

        return $columns;
    }

}
