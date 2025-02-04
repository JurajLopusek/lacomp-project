<?php

namespace App\Filament\Enums;

use App\Constants\RolesConst;
use App\Models\User;
use Filament\Support\Contracts\HasLabel;
use InvalidArgumentException;

enum FilamentPanelEnum: string implements HasLabel
{
    case ADMIN = 'admin';

    /**
     * @throws InvalidArgumentException
     */
    public function hasRights(User $user): bool
    {
        if ($user->hasRole(RolesConst::ADMIN)) {
            return true;
        }

        return match ($this) {
            self::ADMIN => $user->hasRole(RolesConst::ADMIN),
        };
    }

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
