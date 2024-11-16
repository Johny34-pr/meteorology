<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $type = $_GET['type'] ?? 'month'; // Alapértelmezett típus: 'month'

    switch ($type) {
        case 'month':
            $report = $db->listMonthReport();
            break;
        case 'season':
            $report = $db->listSeasonReport();
            break;
        case 'year':
            $report = $db->listYearReport();
            break;
        default:
            $report = [];
    }

    // JSON válasz visszaküldése
    header('Content-Type: application/json');
    echo json_encode($report);
    exit;
}
?>