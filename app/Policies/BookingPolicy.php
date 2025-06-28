<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    public function update($user, $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }

    public function delete($user, $booking)
    {
        return $user->role === 'admin' || $user->id === $booking->user_id;
    }
} 