<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MedicinePolicy
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

    public function delete(User $user){
        return ($user->sebagai == 'owner' ? Response::allow() : Response::deny("You must be a super admin"));
    }

    public function edit(User $user){
        return ($user->sebagai == 'owner' ? Response::allow() : Response::deny("You must be a super admin"));
    }
}
