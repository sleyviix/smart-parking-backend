<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use phpDocumentor\Reflection\Types\Boolean;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
//    public function viewAny(User $user)
//    {
//        //
//    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  \App\Models\Reservation  $reservation
     * @return Response|bool
     */
    public function view(User $user, Reservation $reservation):Boolean
    {
        //
        return (int)$user->id == (int)$reservation->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
//    public function create(User $user)
//    {
//        //
//    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  \App\Models\Reservation  $reservation
     * @return Response|bool
     */
    public function update(User $user, Reservation $reservation)
    {
        //
        return $user->id == $reservation->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\Reservation  $reservation
     * @return Response|bool
     */
//    public function delete(User $user, Reservation $reservation)
//    {
//        //
//    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  \App\Models\Reservation  $reservation
     * @return Response|bool
     */
//    public function restore(User $user, Reservation $reservation)
//    {
//        //
//    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  \App\Models\Reservation  $reservation
     * @return Response|bool
     */
//    public function forceDelete(User $user, Reservation $reservation)
//    {
//        //
//    }
}
