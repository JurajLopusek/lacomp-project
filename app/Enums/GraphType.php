<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum GraphType: String
{
    use EnumTrait;

    case LINE = 'line';
    case BAR = 'bar';
    case AREA = 'area';

    public function selectType(): string
    {
        return $this->value;
    }
}
