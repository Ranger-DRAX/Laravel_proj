<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    public function update($user, $branch)
    {
        return $user->role === 'admin' || $user->id === $branch->restaurant->owner_id;
    }

    public function delete($user, $branch)
    {
        return $user->role === 'admin' || $user->id === $branch->restaurant->owner_id;
    }
} 