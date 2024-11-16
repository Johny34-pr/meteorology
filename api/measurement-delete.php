<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['loggedin']) && $_POST['token'] == "DeleteMEasureFromSite21756") {
    $measurement = $_POST["measurement"];


    $dataset = array(
        array("field" => "operator",  "value" => $measurement["operator"]),
        array("field" => "instrument",  "value" => $measurement["instrument"]),
        array("field" => "timestamp",  "value" => $measurement["timestamp"])
    );

    $return = $db->delete_measurement($dataset);

    if ($return) {
        $res = new response("success", "Operátor törölve.");
    } else {
        $res = new response("error", "Operátor törlése nem sikerült. :(");
    }

    echo json_encode($res);
} else {
    $res = new response("error", "Nincs jogosultságod az operátor törléséhez.");
}
