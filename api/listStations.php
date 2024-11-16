<?php

header('Content-Type: application/json; charset=utf-8');

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";
    $stations = $db->select_stations();

if ($stations) {
    $res = new response("success", "Az állomások betöltése sikeres!", $stations);
} else {
    $res = new response("error", "A állomások betöltése sikertelen.");
}
echo json_encode($res);
http_response_code(200);