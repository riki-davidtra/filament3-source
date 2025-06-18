<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Kormi;
use App\Models\User;

class KormiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Kormi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Kormi $kormi): bool
    {
        return $user->checkPermissionTo('view Kormi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Kormi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Kormi $kormi): bool
    {
        return $user->checkPermissionTo('update Kormi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Kormi $kormi): bool
    {
        return $user->checkPermissionTo('delete Kormi');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any Kormi');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Kormi $kormi): bool
    {
        return $user->checkPermissionTo('restore Kormi');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any Kormi');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, Kormi $kormi): bool
    {
        return $user->checkPermissionTo('replicate Kormi');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder Kormi');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Kormi $kormi): bool
    {
        return $user->checkPermissionTo('force-delete Kormi');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any Kormi');
    }
}
