<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\FornasParticipantFile;
use App\Models\User;

class FornasParticipantFilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FornasParticipantFile');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FornasParticipantFile $fornasparticipantfile): bool
    {
        return $user->checkPermissionTo('view FornasParticipantFile');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FornasParticipantFile');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FornasParticipantFile $fornasparticipantfile): bool
    {
        return $user->checkPermissionTo('update FornasParticipantFile');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FornasParticipantFile $fornasparticipantfile): bool
    {
        return $user->checkPermissionTo('delete FornasParticipantFile');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any FornasParticipantFile');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FornasParticipantFile $fornasparticipantfile): bool
    {
        return $user->checkPermissionTo('restore FornasParticipantFile');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any FornasParticipantFile');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, FornasParticipantFile $fornasparticipantfile): bool
    {
        return $user->checkPermissionTo('replicate FornasParticipantFile');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder FornasParticipantFile');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FornasParticipantFile $fornasparticipantfile): bool
    {
        return $user->checkPermissionTo('force-delete FornasParticipantFile');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any FornasParticipantFile');
    }
}
