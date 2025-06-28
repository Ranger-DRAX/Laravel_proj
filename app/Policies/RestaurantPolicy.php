<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    public function update($user, $restaurant)
    {
        return $user->role === 'admin' || $user->id === $restaurant->owner_id;
    }

    public function delete($user, $restaurant)
    {
        return $user->role === 'admin' || $user->id === $restaurant->owner_id;
    }
} 