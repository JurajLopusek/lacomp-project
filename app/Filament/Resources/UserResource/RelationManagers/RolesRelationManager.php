<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Custom\Resource\RelationManagerEnhanced;
use App\Filament\Resources\RoleResource;

class RolesRelationManager extends RelationManagerEnhanced
{
    protected static string $relationship = 'roles';
    public static string $resource = RoleResource::class;
}
