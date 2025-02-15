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
    public function __construct()
    {
        parent::__construct();

        $this->mergeCasts([
            // DATES
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ]);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::creating(static function ($model) {
            /** @var null|User $user */
            $user = Auth::user();
            $model->creator_id = $user->id ?? config('masterConfig.master_user_id');
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(static function ($model) {
            /** @var null|User $user */
            $user = Auth::user();
            $model->updater_id = $user->id ?? config('masterConfig.master_user_id');
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
