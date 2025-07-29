<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function creating(User $user): void
    {
        if (empty($user->username) && !empty($user->email)) {
            $user->username = strstr($user->email, '@', true);
        }
    }

    public function updating(User $user): void
    {
        if ($user->isDirty('avatar_url')) {
            if ($user->getOriginal('avatar_url') && Storage::disk('public')->exists($user->getOriginal('avatar_url'))) {
                Storage::disk('public')->delete($user->getOriginal('avatar_url'));
            }
        }
    }

    public function forceDeleting(User $user): void
    {
        if ($user->avatar_url && Storage::disk('public')->exists($user->avatar_url)) {
            Storage::disk('public')->delete($user->avatar_url);
        }
    }
}
