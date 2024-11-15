<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $email = $password = "";
    $email_err = $password_err = $reg_err = "";

    if (empty(trim($_POST['name']))) {
        $email_err = "Írd be a nevedet.";
    } else {
        $username = trim($_POST['name']);
    }
    if (empty(trim($_POST['email']))) {
        $email_err = "Írd be az email címedet.";
    } else {
        $email = trim($_POST['email']);
    }
    if (empty(trim(($_POST['password'])))) {
        $password_err = "Írd be a jelszavadat.";
    } else {
        $password = trim($_POST['password']);
    }
    if (empty(trim(($_POST['confirm_password'])))) {
        $password_err = "Írd be mégegyszer a jelszavadat.";
    } else {
        $password1 = trim($_POST['confirm_password']);
    }

    if (empty($email_err) && empty($password_err)) {
        if ($password === $password1) {

            $user = $db->select_where("operators", "email", $email);
            if ($user != NULL) {
                $reg_err = "Ezzel az email címmel már regisztráltak!";
            } else {
                $password = hash('sha256', $password);
                $login = $_POST["login"];

                $user = array(
                    "email" => $email,
                    "password" => $password,
                    "username" => $login,
                    "name" => $username
                );
                $reg = $db->insert_into("operators", $user);
                if (!$reg) {
                    $reg_err = "A regisztráció nem sikerült.";
                } else {
                    if (!isset($_SESSION["loggedin"])) {
                        $user = $db->select_where("operators", "email", $email);
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['name'] = $user['name'];
                        $_SESSION['loggedin'] = true;

                        $res = new response("success", "Sikeresen regisztráltál.");
                    }
                }
            }
        } else {
            $password_err = "A jelszavak nem egyeznek!";
        }
    } else {
        $reg_err = "Regisztráció sikertelen.";
    }

    if (!empty($reg_err) || !empty($email_err) || !empty($password_err)) {
        $res = new response("error", $reg_err . "\n" . $email_err . "\n" . $password_err);
    }
    echo json_encode($res);
} else {
    header("location: /404");
}
