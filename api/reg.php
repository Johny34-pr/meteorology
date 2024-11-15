<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['token'] === "RegisterUserFromSite6432") {

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

                $user = $db->select_where("magyarbi_main", "users", "email", $email);
                if ($user != NULL) {
                    $reg_err = "Ezzel az email címmel már regisztráltak!";
                } else {
                    $password = hash('sha256', $password);
                    if (isset($_POST["login"]) && isset($_POST["rang"])) {
                        $login = $_POST["login"];
                        $rang = $_POST["rang"];

                        $user = array(
                            "email" => $email,
                            "password" => $password,
                            "name" => $username,
                            "login" => $login,
                            "rang" => $rang,
                            "profile_picture" => "default.jpg"
                        );
                    } else {
                        $user = array(
                            "email" => $email,
                            "password" => $password,
                            "name" => $username,
                            "profile_picture" => "default.jpg"
                        );
                    }
                    $reg = $db->insert_into("magyarbi_main", "users", $user);
                    if (!$reg) {
                        $reg_err = "A regisztráció nem sikerült.";
                    } else {
                        header("Location: /");
                        /*
                        if (!isset($_SESSION["loggedin"])) {
                            $user = $db->select_where("magyarbi_main", "users", "email", $email);
                            $_SESSION['id'] = $user['id'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['loggedin'] = "true";
                            $_SESSION['name'] = $user['name'];
                            $_SESSION['rank'] = $user['rang'];
                            $_SESSION['profile_picture'] = $user['profile_picture'];
                        }
                            */
                    }
                }
            } else {
                $password_err = "A jelszavak nem egyeznek!";
            }
        } else {
            $reg_err = "Regisztráció sikertelen.";
        }
    } else {
        $reg_err = "Regisztráció sikertelen.";
    }

    if (!empty($reg_err) || !empty($email_err) || !empty($password_err)) {
        $res = array(
            "result" => "error",
            "log" => $reg_err . "\n" . $email_err . "\n" . $password_err
        );
    } else {
        $res = array(
            "result" => "success",
            "log" => "Regisztráció sikeres!"
        );
    }
    echo json_encode($res);
} else {
    header("location: ../../error/404.html");
}
