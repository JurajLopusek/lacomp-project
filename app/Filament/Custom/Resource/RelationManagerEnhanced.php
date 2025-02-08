<?php

namespace App\Filament\Custom\Resource;

use Exception;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use RuntimeException;

class RelationManagerEnhanced extends RelationManager
{
    /**
     * @return ResourceEnhanced
     */
    public static function getResource(): ResourceEnhanced
    {
        try {
            // TODO MK: Access to an undefined static property static(App\Filament\Custom\Resource\RelationManagerEnhanced)::$resource.
            /** @phpstan-ignore-next-line */
            return App::make(static::$resource);
        } catch (Exception $e) {
            throw new RuntimeException("Failed to resolve resource", 0, $e);
        }
    }

    public function table(Table $table): Table
    {
        $table = static::getResource()::table($table);
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
        $icon = self::getResource()::getNavigationIcon();

        return $icon instanceof Htmlable ? null : $icon;
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
