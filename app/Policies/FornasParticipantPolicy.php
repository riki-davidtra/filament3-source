<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\FornasParticipant;
use App\Models\User;

class FornasParticipantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FornasParticipant');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FornasParticipant $fornasparticipant): bool
    {
        return $user->checkPermissionTo('view FornasParticipant');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FornasParticipant');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FornasParticipant $fornasparticipant): bool
    {
        return $user->checkPermissionTo('update FornasParticipant');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FornasParticipant $fornasparticipant): bool
    {
        return $user->checkPermissionTo('delete FornasParticipant');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any FornasParticipant');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FornasParticipant $fornasparticipant): bool
    {
        return $user->checkPermissionTo('restore FornasParticipant');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any FornasParticipant');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, FornasParticipant $fornasparticipant): bool
    {
        return $user->checkPermissionTo('replicate FornasParticipant');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder FornasParticipant');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FornasParticipant $fornasparticipant): bool
    {
        return $user->checkPermissionTo('force-delete FornasParticipant');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any FornasParticipant');
    }
}
