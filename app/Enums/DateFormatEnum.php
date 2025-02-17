<?php

namespace App\Enums;

enum DateFormatEnum: string
{
    case YMD = 'Y-m-d';
    case YMDHIS = 'Y-m-d H:i:s';
    case DMY_HI = 'd.m.Y H:i';
    case DMY_HIS = 'd.m.Y H:i:s';
    case DDMMYYYY_LOWER = 'dd.mm.yyyy';
    case DDMMYYYY_HIS_LOWER = 'dd.mm.yyyy H:i:s';
    case DMY = 'd.m.Y';
    case HMS = 'H:i:s';
    case HI = 'H:i';
    case DDMMYYYY_UPPER = 'DD.MM.YYYY';
}
