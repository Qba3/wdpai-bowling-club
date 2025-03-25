<?php

require_once '../../../di_config.php';


$di = DI::getInstance();

$tableData = [];

foreach ($di->reservationRepository->findReservationsByUserId($_GET['userId']) as $reservation) {
    $tableData[] = [
        "user_id" => $reservation->getUserId(),
        "day" => $reservation->getDay(),
        "hour" => $reservation->getHour(),
    ];
};

header('Content-Type: application/json');
echo json_encode($tableData);