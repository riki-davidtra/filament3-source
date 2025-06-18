<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ConfigGroup;
use App\Models\User;

class ConfigGroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any ConfigGroup');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ConfigGroup $configgroup): bool
    {
        return $user->checkPermissionTo('view ConfigGroup');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create ConfigGroup');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ConfigGroup $configgroup): bool
    {
        return $user->checkPermissionTo('update ConfigGroup');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ConfigGroup $configgroup): bool
    {
        return $user->checkPermissionTo('delete ConfigGroup');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any ConfigGroup');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ConfigGroup $configgroup): bool
    {
        return $user->checkPermissionTo('restore ConfigGroup');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any ConfigGroup');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, ConfigGroup $configgroup): bool
    {
        return $user->checkPermissionTo('replicate ConfigGroup');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder ConfigGroup');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ConfigGroup $configgroup): bool
    {
        return $user->checkPermissionTo('force-delete ConfigGroup');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any ConfigGroup');
    }
}
