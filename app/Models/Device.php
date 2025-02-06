<?php

namespace App\Models;

use Database\Factories\DeviceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperDevice
 */
class Device extends GeneralModel
{
    /** @use HasFactory<DeviceFactory> */
    use HasFactory;

    protected $table = 'devices';
    protected $fillable = [
        'serial_number',
        'name',
        'location',
        'active',

        'created_at',
        'updated_at',

        'creator_id',
        'updater_id',
    ];
    protected $casts = [
        'serial_number' => 'string',
        'name' => 'string',
        'location' => 'string',
        'active' => 'boolean',

        'creator_id' => 'integer',
        'updater_id' => 'integer',
    ];
}
