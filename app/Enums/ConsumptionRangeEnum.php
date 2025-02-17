<?php

namespace App\Enums;

use App\Traits\EnumTrait;
use Carbon\Carbon;

enum ConsumptionRangeEnum: string
{
    use EnumTrait;

    case HOUR = 'Hodiny';
    case DAY = 'Dňa';
    case MONTH = 'Mesiaca';
    case YEAR = 'Roka';

    public function selectRaw(): string
    {
        return match ($this) {
            self::HOUR => "DATE_FORMAT(time, '%Y-%m-%d %H:00:00')",
            self::DAY => "DATE_FORMAT(time, '%Y-%m-%d 00:00:00')",
            self::MONTH => "DATE_FORMAT(time, '%Y-%m-00 00:00:00')",
            self::YEAR => "DATE_FORMAT(time, '%Y-00-00 00:00:00')",
        };
    }

    public function formatDateFromCarbon(Carbon $carbon): string
    {
        return match ($this) {
            self::HOUR => $carbon->format('d.m H') . ':00',
            self::DAY => $carbon->format('d.m.Y'),
            self::MONTH => $carbon->format('m.Y'),
            self::YEAR => $carbon->format('Y'),
        };
    }
}
