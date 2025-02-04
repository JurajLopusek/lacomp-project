<?php

namespace App\Models;

use App\Filament\Enums\FilamentPanelEnum;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use CanResetPassword;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'updated_at',
        'created_at',
        'deleted_at',

        'creator_id',
        'updater_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',

            'updated_at' => 'datetime',
            'created_at' => 'datetime',
            'deleted_at' => 'datetime',

            'creator_id' => 'integer',
            'updater_id' => 'integer',
        ];
    }

    /**
     * @throws Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return FilamentPanelEnum::from($panel->getId())->hasRights($this);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(self::class, 'creator_id')->withDefault();
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(self::class, 'updater_id');
    }
}
