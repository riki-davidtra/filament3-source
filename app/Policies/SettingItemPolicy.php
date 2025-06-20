<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SettingItem;
use App\Models\User;

class SettingItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any SettingItem');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SettingItem $settingitem): bool
    {
        return $user->checkPermissionTo('view SettingItem');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create SettingItem');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SettingItem $settingitem): bool
    {
        return $user->checkPermissionTo('update SettingItem');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SettingItem $settingitem): bool
    {
        return $user->checkPermissionTo('delete SettingItem');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any SettingItem');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SettingItem $settingitem): bool
    {
        return $user->checkPermissionTo('restore SettingItem');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any SettingItem');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, SettingItem $settingitem): bool
    {
        return $user->checkPermissionTo('replicate SettingItem');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder SettingItem');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SettingItem $settingitem): bool
    {
        return $user->checkPermissionTo('force-delete SettingItem');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any SettingItem');
    }
}
