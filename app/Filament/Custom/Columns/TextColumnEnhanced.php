<?php

namespace App\Filament\Custom\Columns;

use App\Enums\DateFormatEnum;
use App\Filament\Traits\OperatorOptionTrait;
use App\Filament\Traits\WhereClauseAttributeTrait;
use Carbon\Carbon;
use Closure;
use Exception;
use Filament\Support\Enums\ArgumentValue;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class TextColumnEnhanced extends TextColumn
{
    use OperatorOptionTrait;
    use WhereClauseAttributeTrait;

    protected Closure|bool $isSortable = true;
    protected ?array $sortColumns = null;
    protected bool $isSearchable = true;
    protected bool $isGloballySearchable = true;
    protected bool $isIndividuallySearchable = true;

    /**
     * Depends on order apply
     * @param Closure|null $query
     * @param Closure|null $sortQuery
     * @return $this
     */
    public function enhance(?Closure $query = null, ?Closure $sortQuery = null): static
    {
        if ($query) {
            $this->searchQuery = $query;
        } else {
            $operator = $this->getOperator();
            $whereSqlKey = $this->getWhereClauseAttribute();
            $possibleWhereIn = $this->isWhereInOption();
            $isDate = ($this->isDate() or $this->isDateTime());
            $this->searchQuery = (static function (Builder $query, string $search) use ($whereSqlKey, $operator, $possibleWhereIn, $isDate): Builder {
                if ($search === 'NULL') {
                    return $query->whereNull(DB::raw($whereSqlKey));
                }
                if ($search === 'NOT NULL') {
                    return $query->whereNotNull(DB::raw($whereSqlKey));
                }
                $search = static::beforeSearchKeyHook($search);
                if ($isDate) {
                    $search = preg_replace('/\s+/', '', $search);
                    $dateToSearch = $search;
                    if (strlen($search) >= 8) {
                        try {
                            $carbonValue = Carbon::parse($search);
                            if ($carbonValue->isValid()) {
                                $dateToSearch = $carbonValue->toDateString();
                            }
                        } catch (Exception $e) {
                            //
                        }
                    } else {
                        $dateToSearch = "%{$dateToSearch}%";
                    }

                    return $query->where(DB::raw("DATE_FORMAT({$whereSqlKey}, '%Y-%m-%d')"), $operator, $dateToSearch);
                }
                if ($possibleWhereIn) {
                    $delimiter = null;
                    if (Str::contains($search, ';')) {
                        $delimiter = ';';
                    }
                    if (Str::contains($search, ',')) {
                        $delimiter = ',';
                    }
                    if ($delimiter) {
                        $arraySearch = str_getcsv($search, $delimiter);
                        $arraySearch = array_filter($arraySearch);
                        if ($arraySearch) {
                            return $query->whereIn(DB::raw($whereSqlKey), $arraySearch);
                        }
                    }
                }
                if ($operator === self::OPERATOR_LIKE) {
                    $likeTerm = $search;
                    if (!Str::startsWith($search, '%') && !Str::endsWith($search, '%')) {
                        $likeTerm = "%{$search}%";
                    }

                    return $query->where(DB::raw($whereSqlKey), $operator, $likeTerm);
                }

                return $query->where(DB::raw($whereSqlKey), $operator, $search);
            });
        }

        if ($sortQuery) {
            $this->sortQuery = $sortQuery;
        } else {
            $sortSqlKey = $this->getSortClauseAttribute();
            $this->sortQuery = (static function (Builder $query, string $direction = '') use ($sortSqlKey): Builder {
                return $query->orderBy(DB::raw($sortSqlKey), $direction);
            });
        }

        if ($this->isSearchable) {
            $this->extraAttributes(['style' => 'min-width:140px;'], true);
        }

        return $this;
    }

    public function money(Closure|string|null $currency = null, int $divideBy = 0, Closure|string|null $locale = null): static
    {
        $this->alignEnd();

        return parent::money($currency ?? 'EUR', $divideBy, $locale ?? 'sk');
    }

    public function numeric(int|Closure|null $decimalPlaces = null, string|Closure|null|ArgumentValue $decimalSeparator = ArgumentValue::Default, string|Closure|null|ArgumentValue $thousandsSeparator = ArgumentValue::Default, int|Closure|null $maxDecimalPlaces = null, string|Closure|null $locale = null): static
    {
        if ($decimalSeparator === ArgumentValue::Default) {
            $decimalSeparator = ',';
        }
        if ($thousandsSeparator === ArgumentValue::Default) {
            $thousandsSeparator = '';
        }

        return parent::numeric($decimalPlaces, $decimalSeparator, $thousandsSeparator, $maxDecimalPlaces, $locale);
    }

    public function date(Closure|null|string $format = null, ?string $timezone = null): static
    {
        $this->setTimeDescription();

        return parent::date($format ?? DateFormatEnum::DMY->value, $timezone);
    }

    public function dateTime(Closure|null|string $format = null, ?string $timezone = null): static
    {
        $this->setTimeDescription();

        return parent::dateTime($format ?? DateFormatEnum::DMY_HI->value, $timezone);
    }

    public function time(Closure|null|string $format = null, ?string $timezone = null): static
    {
        $this->setTimeDescription();

        return parent::time($format ?? DateFormatEnum::HI->value, $timezone);
    }

    public function setTimeDescription(): self
    {
        $this->description(function ($state) {
            try {
                return $state?->diffForHumans();
            } catch (Throwable $e) {
                return null;
            }
        });

        return $this;
    }

    public function setHiddenInRelationManager(Model $model): self
    {
        return $this->hidden(function ($livewire) use ($model) {
            $owner = $livewire->ownerRecord ?? false;

            if ($owner) {
                return $owner instanceof $model;
            }

            return $owner;
        });
    }

    public function copyable(bool|Closure $condition = true): static
    {
        if ($this->isDate() || $this->isDateTime()) {
            $dateFormat = DateFormatEnum::DMY->value;
            if ($this->isDateTime()) {
                $dateFormat = DateFormatEnum::DMY_HI->value;
            } elseif ($this->isTime()) {
                $dateFormat = DateFormatEnum::HI->value;
            }
            $this->copyableState = (static function (string $state) use ($dateFormat): string {
                return Carbon::parse($state)->format($dateFormat);
            });
        }

        return parent::copyable($condition);
    }

    /**
     * @return array{0: string}
     */
    public function getDefaultSortColumns(): array
    {
        return [$this->getSortClauseAttribute()];
    }

    /**
     * @return array{0: string}
     */
    public function getDefaultSearchColumns(): array
    {
        return [$this->getWhereClauseAttribute()];
    }

    public function disableSort(): static
    {
        $this->isSortable = false;

        return $this;
    }

    public function disableSearch(): static
    {
        $this->isSearchable = false;

        return $this;
    }

    public function setIdentificatorColumn(): static
    {
        $this->setOperatorEqual()
            ->setPossibleWhereIn()
            ->numeric(thousandsSeparator: '')
            ->toggleable()
            ->copyable();

        return $this;
    }

    /**
     * Manipulate search term before creating search query
     * @param string $search
     * @return string
     */
    public static function beforeSearchKeyHook(string $search): string
    {
        return $search;
    }

    public function link(string|Closure|null $url = null, bool|Closure $shouldOpenInNewTab = false, string $relation = null, string $urlFunction = 'getFrontEndUrl'): static
    {
        if (is_null($url)) {
            $this->url = (static function (Model $model) use ($relation, $urlFunction): ?string {
                $obj = $model;
                if ($relation) {
                    $obj = $model->$relation;
                    if (!$obj) {
                        return null;
                    }
                }

                return $obj->$urlFunction();
            });
        } else {
            $this->url = $url;
        }
        $this->copyable(false);
        $this->openUrlInNewTab($shouldOpenInNewTab);

        return $this;
    }

    public function enum(string $fn = 'name'): static
    {
        return $this->formatStateUsing(fn ($state) => $state->{$fn}());
    }
}
