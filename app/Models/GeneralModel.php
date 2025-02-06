<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin IdeHelperGeneralModel
 */
class GeneralModel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeCasts([
            // DATES
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ]);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            /** @var null|User $user */
            $user = Auth::user();
            $model->creator_id = $user ? $user->id : config('masterConfig.master_user_id');
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(function ($model) {
            /** @var null|User $user */
            $user = Auth::user();
            $model->updater_id = $user ? $user->id : config('masterConfig.master_user_id');
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id')->withDefault();
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updater_id')->withDefault();
    }
}
