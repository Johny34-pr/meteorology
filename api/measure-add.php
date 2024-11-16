<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['token'] == "addMeasureByOperator7264") {
    if ($_SESSION['loggedin'] && isset($_POST['measurement'])) {
        $measurement = $_POST['measurement'];

        // Szűrés a nem null vagy üres értékekre
        $measurement = array_filter($measurement, function ($value) {
            return !is_null($value) && $value !== '';
        });

        $renameMap = [
            'instrument' => 'instrument_id',
            'station' => 'location_id'
        ];
        
        // Új tömb létrehozása az átnevezett kulcsokkal
        $renamedData = [];
        foreach ($measurement as $oldKey => $value) {
            $newKey = $renameMap[$oldKey] ?? $oldKey; // Ha nincs új név, megtartja a régit
            $renamedData[$newKey] = $value;
        }

        unset($measurement);
        $measurement = $renamedData;
        unset($renamedData);

        $measurement["operator_id"] = $_SESSION["operator_id"];

        $return = $db->insert_into("measurements", $measurement);

        if ($return) {
            $res = new response("success", "A mérés rögzítése sikeres!");
        } else {
            $res = new response("error", "A mérés rögzítése sikertelen.");
        }
    } else {
        $res = new response("error", "Nincs jogosultságod a kért művelethez!");
    }
    echo json_encode($res);
} else {
    header("location: /error/404.html");
}
