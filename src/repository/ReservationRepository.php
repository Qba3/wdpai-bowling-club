<?php

namespace App\repository;

use PDO;
use Reservation;

require_once(__DIR__ . '/../model/Reservation.php');

class ReservationRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchReservationsByUserId(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT id, day, hour FROM reservations WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllReservations(): array
    {
        $stmt = $this->pdo->prepare("SELECT user_id, day, hour FROM reservations ");
        $stmt->execute();
        $reservationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $reservations = [];
        if ($reservationsData) {
            foreach ($reservationsData as $data) {
                $reservations[] = new Reservation(
                    $data['user_id'],
                    $data['day'],
                    $data['hour']
                );
            }
        }

        return $reservations;
    }

    public function save(mixed $userId, mixed $day, mixed $hour): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO reservations (user_id, day, hour) 
                                 VALUES (:user_id, :day, :hour)");

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':day', $day);
        $stmt->bindParam(':hour', $hour);

        return $stmt->execute();
    }

    public function deleteReservationById(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM reservations WHERE id = :id');
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}