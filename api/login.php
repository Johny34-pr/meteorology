<?php

include $_SERVER["DOCUMENT_ROOT"] . "/core/init.php";

$email = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['email']))) {
        $username_err = true;
        // $username_err = "Írd be a felnasználó nevedet.";
    } else {
        $email = trim($_POST['email']);
    }
    if (empty(trim(($_POST['password'])))) {
        $password_err = true;
        // $password_err = "Írd be a jelszavadat.";
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $user = $db->select_where("magyarbi_main", "users", "email", $email);
        if ($user != NULL) {
            if (hash('sha256', $password) === $user['password']) {
                if ($user['enabled'] === 1) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['user'] = $user['login'];
                    $_SESSION['bio'] = $user['bio'];
                    $_SESSION['email'] = $email;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['rank'] = $user['rang'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['bio'] = $user['bio'];
                    $_SESSION['profile_picture'] = $user['profile_picture'];
                    $_SESSION['enabled'] = $user['enabled'];

                    $res = new response("success", "Sikeresen bejelentkeztél.");
                    // header("location: /index.php");
                } else {
                    $login_err = "A felhasználói fiókod inaktív. A probléma megoldásához keresd az oldal kezelőjét.";
                }
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
        // echo $login_err;
        //$login_err = $login_err + "A bejelentkezés sikertelen!";
        $res = new response("error", $login_err . " A bejelentkezés sikertelen!");
    }
    echo json_encode($res);
}
