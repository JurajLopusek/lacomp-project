<?php

namespace App\Filament\Custom\Filters;

use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SelectFilterEnhanced extends SelectFilter
{
    protected bool $castToInt = false;

    /**
     * @param Builder<Model> $query
     * @param array<string, array<string, string>> $data
     * @return Builder<Model>
     */
    public function apply(Builder $query, array $data = []): Builder
    {
        $isMultiple = $this->isMultiple();
        $values = $isMultiple ?
            $data['values'] ?? null :
            $data['value'] ?? null;

        if ($values && $this->useCastToInt()) {
            if ($isMultiple) {
                $data['values'] = array_map('intval', $data['values']);
            } else {
                $data['value'] = (int)$data['value'];
            }
        }

        return parent::apply($query, $data);
    }

    /**
     * Enum columns in DB can be searched by int (index of enum array) - need to be cast as integer
     * @return $this
     */
    public function castToInt(): static
    {
        $this->castToInt = true;

        return $this;
    }

    public function useCastToInt(): bool
    {
        return $this->castToInt;
    }
}
