<?php
session_start();
require "connection.php";

$email = $_POST["email"];
$pw = $_POST["pw"];
$remember = $_POST["remember"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' && `password`='" . $pw . "' ");

$user_num = $user_rs->num_rows;

if ($user_num == 1) {

    $user_d = $user_rs->fetch_assoc();

    if ($user_d["a_status"] == 1) {

        echo ("success");

        $_SESSION["u"] = $user_d;

        if ($remember == "check") {
            setcookie("u_email", $email, time() + 60 * 60 * 24 * 7);
            setcookie("u_pw", $pw, time() + 60 * 60 * 24 * 7);
        } else if ($remember == "no") {
            setcookie("u_email", $email, time());
            setcookie("u_pw", $pw, time());
        }
    }else{
        echo("blocked");
    }
} else {
    echo ("Invalid Email or Password");
}
?>