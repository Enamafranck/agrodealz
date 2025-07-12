<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reservations.
     */
    public function viewAny(User $user)
    {
        return true; // Tous les utilisateurs connectés peuvent voir leurs réservations
    }

    /**
     * Determine whether the user can view the reservation.
     */
    public function view(User $user, Reservation $reservation)
    {
        // Utilisation du bon nom de champ : iduser (selon votre controller)
        return $user->id === $reservation->iduser;
    }

    /**
     * Determine whether the user can create reservations.
     */
    public function create(User $user)
    {
        return true; // Tous les utilisateurs connectés peuvent créer des réservations
    }

    /**
     * Determine whether the user can update the reservation.
     */
    public function update(User $user, Reservation $reservation)
    {
        // Correction : utilisation de iduser au lieu de user_id
        return $user->id === $reservation->iduser;
    }

    /**
     * Determine whether the user can delete the reservation.
     */
    public function delete(User $user, Reservation $reservation)
    {
        // Correction : utilisation de iduser au lieu de user_id
        return $user->id === $reservation->iduser && in_array($reservation->statut, ['en_attente', 'confirmee']);
    }

    /**
     * Determine whether the user can confirm the reservation.
     */
    public function confirmer(User $user, Reservation $reservation)
    {
        // Permettre à tous les utilisateurs connectés ou seulement au propriétaire
        return true; // ou return $user->id === $reservation->iduser;
    }

    /**
     * Determine whether the user can cancel the reservation.
     */
    public function annuler(User $user, Reservation $reservation)
    {
        // Permettre à tous les utilisateurs connectés ou seulement au propriétaire
        return true; // ou return $user->id === $reservation->iduser;
    }
}