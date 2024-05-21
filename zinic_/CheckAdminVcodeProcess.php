<?php

require "connection.php";
session_start();

if (isset($_GET["vcode"]) && isset($_GET["email"])) {
    $vcode = $_GET["vcode"];
    $email = $_GET["email"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE vcode='" . $vcode . "' && email='" . $email . "' ");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {
        $admin_d = $admin_rs->fetch_assoc();
        $_SESSION["au"] = $admin_d;
        echo ("success");
    } else {
        echo ("Invalide Verification Code");
    }
} else {
    echo ("Something Went Wromg");
}
?>