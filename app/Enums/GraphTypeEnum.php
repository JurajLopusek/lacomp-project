<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum GraphTypeEnum: String
{
    use EnumTrait;

    case LINE = 'line';
    case BAR = 'bar';
    case AREA = 'area';

    public function name(): string
    {
        return match ($this) {
            self::LINE => 'Čiarový graf',
            self::BAR => 'Stĺpcový graf',
            self::AREA => 'Area graf'
        };
    }
}
