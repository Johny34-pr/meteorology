<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['token'] == "SelectAllUserFromDBOnAdminPg5345") {
    if($_SESSION['loggedin']){
        if(isset($_POST["field"]) && !empty($_POST["field"])){
            $users = $db->select_operators($_POST["field"], $_POST["order"]);
        }else{
            $users = $db->select_operators();
        }

    if ($users) {
        $res = new response("success", "A felhasználók betöltése sikeres!", $users);
    } else {
        $res = new response("error", "A felhasználók betöltése sikertelen.");
    }
    }else{
       $res = new response("error", "Nincs jogosultságod a kért művelethez!");
    }
    echo json_encode($res);
} else {
    header("location: /error/404.html");
}
