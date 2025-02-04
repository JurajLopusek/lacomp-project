<?php

namespace App\Filament\Custom\Resource;


use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RelationManagerEnhanced extends RelationManager
{
    /**
     * Get the resource class name.
     *
     * @return class-string|null
     */
    public static function getResource(): ?string
    {
        // TODO MK: Access to an undefined static property static(App\Filament\Custom\Resource\RelationManagerEnhanced)::$resource.
        /** @phpstan-ignore-next-line  */
        return static::$resource;
    }

    public function table(Table $table): Table
    {
        $table = self::getResource()::table($table);
        $table->paginationPageOptions(static::getPaginateOptions());
        $table->modifyQueryUsing(function (Builder $query) {
            return self::getResource()::getResourceEloquentQuery($query);
        });

        return $table;
    }

    public function form(Form $form): Form
    {
        return self::getResource()::form($form);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return self::getResource()::getPluralLabel() ?? '';
    }

    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return self::getResource()::getNavigationIcon();
    }

    /**
     * @return array<int>
     */
    protected static function getPaginateOptions(): array
    {
        return [10, 25, 100, 250, 1000];
    }

    public function isReadOnly(): bool
    {
        return false;
    }

}
