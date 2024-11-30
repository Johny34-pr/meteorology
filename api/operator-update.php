<?php

// header('Content-Type: application/json; charset=utf-8');

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['loggedin']) && $_POST['token'] == "OperatorUpdateFromSite442538") {
    $operator = $_POST["operator"];

    // $location = $db->select_where("locations", "station_name", $operator["location_id"], "location_id");
    // $location_id = $location["location_id"];
    // unset($location);

    $operators = [
        [
            'name' => $operator["name"],
            'reg_time' => $operator['reg_time'],
            'updateFields' => [
                'name' => $operator["name"],
                'email' => $operator["email"],
                'location_id' => $operator["location_id"]
            ]
        ]
    ];

    $return = $db->update_operator($operators);

    if ($return) {
        $res = new response("success", "Operátor frissítve.");
    } else {
        $res = new response("error", "Operátor frissítése nem sikerült. :(");
    }

    echo json_encode($res);
} else {
    $res = new response("error", "Nincs jogosultságod az operátor frissítéséhez.");
}
