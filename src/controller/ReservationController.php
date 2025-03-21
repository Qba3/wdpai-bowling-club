<?php

use App\service\reservation\ReservationService;

require_once 'Controller.php';

class ReservationController extends Controller
{
    private ReservationService $reservationService;

    /**
     * @param ReservationService $reservationService
     */
    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function getSchedule(): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            die("Error");
        };

        $id = $_SESSION['user_id'];
        $reservations = $this->reservationService->getReservationsByUserId((int)$id);

        $reservationsData = [];
        foreach ($reservations as $reservation) {
            $reservationsData[$reservation->getDay() . "-" . $reservation->getHour()] = [
                $reservation->getUserId(),
                $reservation->getDay(),
                $reservation->getHour(),
                $reservation->isDrinkOffer(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($reservationsData);
    }
}