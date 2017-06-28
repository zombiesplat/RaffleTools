<?php

namespace App\Policies;

use App\Model\Item;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
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

    /**
     * Determine whether the user can update the order.
     *
     * @param User $user
     * @param Item $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        return $user->onTeam($item->event->team);
    }

}
