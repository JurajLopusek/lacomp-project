<?php

namespace App\Filament\Custom\Inputs;

use App\Models\User;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;

class UserSelect
{
    private static string $key = 'filament_label';

    public static function factory(string $name = 'user_id'): Select
    {
        $model = User::getModel();

        return Select::make($name)
            ->live()
            ->label('Používateľ')
            ->placeholder('Vyberte používateľa')
            ->options($model::limit(25)->orderByDesc($model->getKeyName())->get()->pluck(self::$key, $model->getKeyName()))
            ->getSearchResultsUsing(fn (string $search) => $model::where(static function (Builder $q) use ($search, $model) {
                $q->where($model->getKeyName(), $search);
                $q->orWhere('name', 'like', "%{$search}%");
                $q->orWhere('email', 'like', "%{$search}%");
            })->limit(25)
                ->get()
                ->pluck(self::$key, $model->getKeyName()))
            ->getOptionLabelUsing(fn (string $value) => $model::find($value)?->{self::$key})
            ->getOptionLabelsUsing(fn (array $values): array => $model::whereIn($model->getKeyName(), $values)->get()->pluck(self::$key, $model->getKeyName())->toArray())
            ->optionsLimit(25)
            ->searchable();
    }
}
