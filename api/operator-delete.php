<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['loggedin']) && $_POST['token'] == "DeleteOperatorFromSite4234") {
    $operator = $_POST["operator"];

    $operator_id = $db->select_where("operators", "name", $operator["name"]);
    $operator_id = $operator_id[0]["operator_id"];

    $isExist = $db->select_where("measurements", "operator_id", $operator_id, "measurement_id");

    $success = false;

    foreach($isExist as $measurement){
        $success = $db->delete_where("measurements", "measurement_id", $measurement["measurement_id"]);
        if(!$success){
            break;
        }
    }

    if($success){
        $dataset = array(
            array("field" => "name",  "value" => $operator["name"]),
            array("field" => "reg_time",  "value" => $operator["reg_time"])
        );
    
        $return = $db->delete_operator($dataset);
    
        if ($return) {
            $res = new response("success", "Operátor törölve.");
        } else {
            $res = new response("error", "Operátor törlése nem sikerült. :(");
        }
    }

    echo json_encode($res);
} else {
    $res = new response("error", "Nincs jogosultságod az operátor törléséhez.");
}
