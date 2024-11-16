<?php

header('Content-Type: application/json; charset=utf-8');

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

$measurements = $db->select_measurements();

if ($measurements) {
    $res = new response("success", "A mérések betöltése sikeres!", $measurements);
} else {
    $res = new response("error", "A mérések betöltése sikertelen.");
}
echo json_encode($res);
http_response_code(200);
