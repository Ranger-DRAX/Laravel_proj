<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function update($user, $payment)
    {
        return $user->role === 'admin' || $user->id === $payment->booking->user_id;
    }

    public function delete($user, $payment)
    {
        return $user->role === 'admin' || $user->id === $payment->booking->user_id;
    }
} 