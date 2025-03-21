<?php

require_once 'Controller.php';

class ReservationController extends Controller
{
    public function getSchedule(): void
    {
        session_start();
        header('Content-Type: application/json');
        echo json_encode(["msg" => "elo"]);
    }
}