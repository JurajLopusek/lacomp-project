<?php

namespace App\Models;

use App\Observers\GeneralModelObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperGeneralModel
 */
#[ObservedBy(GeneralModelObserver::class)]
class GeneralModel extends Model
{
    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable([
            'created_at',
            'updated_at',

            'creator_id',
            'updater_id',
        ]);

        $this->mergeCasts([
            // DATES
            'created_at' => 'datetime',
            'updated_at' => 'datetime',

            'creator_id' => 'integer',
            'updater_id' => 'integer',
        ]);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id')->withDefault();
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updater_id')->withDefault();
    }
}
