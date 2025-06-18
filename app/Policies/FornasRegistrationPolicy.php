<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\FornasRegistration;
use App\Models\User;

class FornasRegistrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FornasRegistration');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FornasRegistration $fornasregistration): bool
    {
        return $user->checkPermissionTo('view FornasRegistration');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FornasRegistration');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FornasRegistration $fornasregistration): bool
    {
        return $user->checkPermissionTo('update FornasRegistration');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FornasRegistration $fornasregistration): bool
    {
        return $user->checkPermissionTo('delete FornasRegistration');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any FornasRegistration');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FornasRegistration $fornasregistration): bool
    {
        return $user->checkPermissionTo('restore FornasRegistration');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any FornasRegistration');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, FornasRegistration $fornasregistration): bool
    {
        return $user->checkPermissionTo('replicate FornasRegistration');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder FornasRegistration');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FornasRegistration $fornasregistration): bool
    {
        return $user->checkPermissionTo('force-delete FornasRegistration');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any FornasRegistration');
    }
}
