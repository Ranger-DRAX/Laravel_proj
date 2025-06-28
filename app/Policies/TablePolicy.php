<?php

namespace App\Policies;

use App\Models\Table;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TablePolicy
{
    use HandlesAuthorization;

    public function update($user, $table)
    {
        return $user->role === 'admin' || $user->id === $table->branch->restaurant->owner_id;
    }

    public function delete($user, $table)
    {
        return $user->role === 'admin' || $user->id === $table->branch->restaurant->owner_id;
    }
} 