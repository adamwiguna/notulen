<?php

namespace App\Providers;

use App\Models\Note;
use App\Policies\NotePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Note::class => NotePolicy::class,
        User::class => UserPolicy::class,
        History::class => HistoryPolicy::class,
        Note_Image::class => NoteImagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('notes_edit', function(User $user, Note $notes)
        // {
        //     return $user->is_admin || (auth()->check() && $note->user_id == auth()->user()->id)  ;
        // });

        //
    }
}
