<?php

namespace App\service\reservation;

use App\repository\ReservationRepository;

require_once(__DIR__ . '/../../model/User.php');

class ReservationService
{
    private ReservationRepository $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function getReservationsByUserId(int $userId): array
    {
        return $this->reservationRepository->findReservationsByUserId($userId);
    }

    public function getAllReservations(): array
    {
        return $this->reservationRepository->getAll();
    }

    public function save(mixed $userId, mixed $day, mixed $hour): bool
    {
        return $this->reservationRepository->save($userId, $day, $hour);
    }
}