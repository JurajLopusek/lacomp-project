<?php

namespace App\Filament\Custom\Resource;

use App\Filament\Custom\Columns\TextColumnEnhanced;
use App\Filament\Traits\CommonColumnsTrait;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ResourceEnhanced extends Resource
{
    protected static int $globalSearchResultsLimit = 20;
    protected static ?string $recordTitleAttribute = 'filament_label';
    public static bool $hideCommonColumns = true;

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return static::getUrl('view', ['record' => $record]);
    }

    public static function getRecordTitle(?Model $record): string| null|Htmlable
    {
        $modelLabel = self::getModelLabel();

        if (!$record) {
            return $modelLabel;
        }

        $modelStr = "#{$record->getKey()}";

        if (isset($record->filament_label)) {
            /** @var string $filamentLabel */
            $filamentLabel = $record->filament_label;
            $modelStr = Str::replace('|', '-', $filamentLabel);
        } elseif (property_exists($record::class, 'selectTextField')) {
            /* @phpstan-ignore-next-line property_exists doesnt help */
            $attr = $record::$selectTextField;  // TODO MK: fix
            $modelStr = $record->$attr;
        } elseif ($record->getAttribute('title')) {
            $modelStr = $record->getAttribute('title');
        } elseif ($record->getAttribute('name')) {
            $modelStr = $record->getAttribute('name');
        }

        return sprintf('%s: %s', $modelLabel, $modelStr);
    }

    /**
     * @return array<Component>
     */
    public static function getForm(): array
    {
        return [];
    }

    /**
     * @param Builder<Model> $query
     * @return Builder<Model>
     */
    public static function getResourceEloquentQuery(Builder $query): Builder
    {
        return $query;
    }

    public static function table(Table $table): Table
    {
        $table->paginationPageOptions(static::getPaginateOptions())
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->recordAction(fn (): null => null)
            ->recordUrl(fn (): null => null)
            ->searchOnBlur();

        if (is_null($table->getDefaultSortColumn())) {
            $table->defaultSort(self::getRecordRouteKeyName(), 'desc');
        }

        $resourceUses = class_uses(static::class);

        $shouldHide = static::$hideCommonColumns;
        if (in_array(CommonColumnsTrait::class, $resourceUses, true)) {
            $table->pushColumns(
                static::getCommonColumns($table, $shouldHide),
            );
        }

        foreach ($table->getColumns() as $column) {
            if ($column instanceof TextColumnEnhanced) {
                $column->enhance();
            }
        }

        return $table;
    }

    /**
     * @return array<int, int|string>
     */
    protected static function getPaginateOptions(): array
    {
        $pageOptions = collect([10, 25, 100, 250, 1000]);
        $pageOptionsWithStats = collect($pageOptions->map(fn ($pageOption): string => $pageOption . ' + ' . ListRecordsEnhanced::STATS_TEXT));

        // TODO MK: Parameter #1 $items of method Illuminate\Support\Collection<int,int>::merge() expects Illuminate\Contracts\Support\Arrayable<int, int>|iterable<int, int>, Illuminate\Support\Collection<int, string> given.
        /** @phpstan-ignore-next-line  */
        return $pageOptions->merge($pageOptionsWithStats)->all();
    }

    /**
     * @return array<TextColumn|TextColumnEnhanced>
     */
    protected static function getCommonColumns(Table $table, bool $hideCommonColumns = false): array
    {
        return [];
    }
}
