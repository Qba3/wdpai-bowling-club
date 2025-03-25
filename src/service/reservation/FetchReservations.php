<?php

require_once '../../../di_config.php';


$di = DI::getInstance();

$tableData = [];

foreach ($di->reservationRepository->fetchReservationsByUserId($_GET['userId']) as $reservation) {
    $tableData[] = [
        "id" => $reservation["id"],
        "day" => ucfirst($reservation["day"]),
        "hour" => $reservation["hour"] . ":00",
    ];
};

header('Content-Type: application/json');
echo json_encode($tableData);