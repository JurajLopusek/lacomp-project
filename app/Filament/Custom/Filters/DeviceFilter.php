<?php

namespace App\Filament\Custom\Filters;

use App\Models\Device;
use Exception;
use Illuminate\Database\Eloquent\Builder;

final class DeviceFilter
{
    /**
     * @throws Exception
     */
    public static function factory(string $columnName = 'device_id', ?string $label = 'Zariadenie'): SelectFilterEnhanced
    {
        $model = Device::getModel();
        $searchLabel = 'filament_label';

        return SelectFilterEnhanced::make($columnName)
            ->label($label)
            ->searchable()
            ->getSearchResultsUsing(fn ($query, string $search) => $model::where(static function (Builder $q) use ($search) {
                $q->where('id', $search);
                $q->orWhere('name', 'like', "%{$search}%");
                $q->orWhere('serial_number', 'like', "%{$search}%");
            })->limit(25)
                ->get()
                ->pluck($searchLabel, $model->getKeyName())
            )
            ->options(fn (): array => $model::latest()->limit(25)->get()->pluck($searchLabel, $model->getKeyName())->toArray())
            ->getOptionLabelsUsing(fn (array $values): array => $model::whereIn($model->getKeyName(), $values)->get()->pluck($searchLabel, $model->getKeyName())->toArray())
            ->getOptionLabelUsing(fn (string $value) => $model::find($value)?->$searchLabel);
    }
}
