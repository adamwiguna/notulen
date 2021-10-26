<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use App\Models\Note_Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoteImagePolicy
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

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note_Image  $noteImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Note_Image $noteImage)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Note $note)
    {
        return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note_Image  $noteImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Note_Image $noteImage)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note_Image  $noteImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Note_Image $noteImage)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note_Image  $noteImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Note_Image $noteImage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Note_Image  $noteImage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Note_Image $noteImage)
    {
        //
    }
}
