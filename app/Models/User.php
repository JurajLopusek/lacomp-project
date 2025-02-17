<?php

namespace App\Models;

use App\Filament\Enums\FilamentPanelEnum;
use App\Filament\Interfaces\FilamentLabelInterface;
use App\QueryBuilders\UserQueryBuilder;
use Database\Factories\UserFactory;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements FilamentUser, FilamentLabelInterface
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use CanResetPassword;

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

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',

        'updated_at',
        'created_at',
        'deleted_at',

        'creator_id',
        'updater_id',
    ];
    protected $appends = [
        'filament_label',
    ];
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

    /**
     * @return BelongsTo<User, $this>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(self::class, 'creator_id')->withDefault();
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(self::class, 'updater_id');
    }

    /**
     * @return BelongsToMany<Device, $this>
     */
    public function devices(): BelongsToMany
    {
        return $this->belongsToMany(Device::class)->withTimestamps();
    }

    public function getFilamentLabelAttribute(): string
    {
        return "#{$this->id} - {$this->name} ({$this->email})";
    }
}
