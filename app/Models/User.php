<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Spatie\Permission\Traits\HasRoles;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, HasRoles, HasSuperAdmin;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'uuid',
        'username',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
        ];
    }

    public $incrementing = true;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid7();
    }

    public function fornasRegistrations()
    {
        return $this->hasMany(FornasRegistration::class);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        // $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');
        // return $this->$avatarColumn ? Storage::url($this->$avatarColumn) : null;

        return $this->avatar_url ? Storage::url("$this->avatar_url") : null;
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->username) && !empty($user->email)) {
                $user->username = strstr($user->email, '@', true);
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('avatar_url')) {
                if ($user->getOriginal('avatar_url') && $user->getOriginal('avatar_url') !== $user->avatar_url) {
                    Storage::disk('public')->delete($user->getOriginal('avatar_url'));
                }
            }
        });

        static::deleting(function ($user) {
            if ($user) {
                if ($user->avatar_url) {
                    Storage::disk('public')->delete($user->avatar_url);
                }
            }
        });
    }
}
