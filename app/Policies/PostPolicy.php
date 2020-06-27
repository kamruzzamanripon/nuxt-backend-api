<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post)
    {
        return $user->ownPost($post);
    }

    public function destroy(User $user, Post $post)
    {
        return $user->ownPost($post);
    }

    public function like(User $user, Post $post)
    {
        return !$user->ownPost($post);
    }
}
