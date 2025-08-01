<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }

    public function create(User $user)
    {
        return true; // Or your custom logic
    }

    public function update(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }

    public function delete(User $user, Cart $cart)
    {
        return $user->id === $cart->user_id;
    }
}