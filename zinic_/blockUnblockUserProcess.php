<?php

require "connection.php";
session_start();

if (isset($_GET["uemail"])) {
    $uemail= $_GET["uemail"];

    $u_rs = Database::search("SELECT * FROM user WHERE email='" . $uemail . "'");
    $u_d = $u_rs->fetch_assoc();
    if ($u_d["a_status"] == 1) {
        Database::iud("UPDATE user SET a_status='0' WHERE email='" . $uemail . "' ");
        echo ("blocked");
    } else if ($u_d["a_status"] == 0) {
        Database::iud("UPDATE user SET a_status='1' WHERE email='" . $uemail . "' ");
        echo ("unblocked");
    }
}
?>