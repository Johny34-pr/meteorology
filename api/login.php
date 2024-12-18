<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

    $email = $password = "";
    $username_err = $password_err = $login_err = "";

    if (empty(trim($_POST['email']))) {
        $username_err = true;
    } else {
        $email = trim($_POST['email']);
    }
    if (empty(trim(($_POST['password'])))) {
        $password_err = true;
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $user = $db->select_where("operators", "email", $email);
        $user = $user[0];
        if ($user != NULL) {
            if (hash('sha256', $password) === $user['password']) {
                $_SESSION['operator_id'] = $user['operator_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['loggedin'] = true;

                $res = new response("success", "Sikeresen bejelentkeztél.");
            } else {
                $login_err = "Hibás felhasználónév vagy jelszó!";
            }
        } else {
            $login_err = "Hibás felhasználónév vagy jelszó!";
        }
    } else {
        $login_err = "Hibás felhasználónév vagy jelszó!";
    }

    if (!empty($login_err)) {
        $res = new response("error", $login_err . " A bejelentkezés sikertelen!");
    }

    echo json_encode($res);
}else{
    header("location: /404");
}
