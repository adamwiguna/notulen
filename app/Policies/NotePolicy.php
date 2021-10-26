<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    public function viewNotesByDivision(User $user)
    {
        return $user->is_admin || ($user->authorization_level >= 1 && isset($user->division->name));
    }

    public function viewAllNotes(User $user)
    {
        return $user->is_admin || $user->authorization_level >= 2;
    
    }
    
    public function viewNewNotes(User $user)
    {
        return $user->is_admin || $user->authorization_level >= 3;
    }

    public function search(User $user)
    {
        return $user->is_admin || $user->authorization_level >= 3;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }
    
    public function addImages(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    public function deleteImages(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    public function addAttendances(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    public function deleteAttendances(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Note $note)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Note $note)
    {
        return $user->is_admin;
    }
}
