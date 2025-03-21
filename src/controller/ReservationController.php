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
        $reservations = $this->reservationService->getAllReservations();

        $reservationsData = [];
        foreach ($reservations as $reservation) {
            $reservationsData[$reservation->getDay() . "-" . $reservation->getHour()] = [
                $id,
                $reservation->getUserId(),
                $reservation->getDay(),
                $reservation->getHour(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($reservationsData);
    }

    public function reserveSlot(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $day = "";
        $hour = "";

        if ($data && isset($data['day']) && isset($data['hour'])) {
            $day = $data['day'];
            $hour = $data['hour'];
        }

        session_start();
        if (!isset($_SESSION['user_id'])) {
            die("Error");
        }
        $userId = $_SESSION['user_id'];
        if ($this->reservationService->save($userId, $day, $hour)) {
            echo json_encode(['status' => 'success', 'message' => 'Slot reserved']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error occurred']);
        }
    }
}