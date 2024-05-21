<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    if (isset($_POST["pid"]) && isset($_POST["qty"])) {

        $email = $_SESSION["u"]["email"];
        $pid = $_POST["pid"];
        $qty = $_POST["qty"];

        $oid = uniqid();

        $u_rs = Database::search("SELECT * FROM `user` INNER JOIN shipping ON shipping.id=user.shipping_id WHERE email='" . $email . "' ");
        $u_d = $u_rs->fetch_assoc();

        $array;

        $array["fname"] = $u_d["fname"];
        $array["lname"] = $u_d["lname"];
        $array["mobile"] = $u_d["mobile1"];
        $array["email"] = $u_d["email"];
        $array["district"] = $u_d["district"];
        $array["address"] = $u_d["line1"] . " / " . $u_d["line2"];
        $array["oid"] = $oid;

        $p_rs = Database::search("SELECT * FROM product WHERE id='" . $pid . "'");
        $p_d = $p_rs->fetch_assoc();

        if (!empty($u_d["line1"]) || !empty($u_d["line2"])) {
            $array["amount"] = (int)$p_d["price"] * (int)$qty + (int)$u_d["fee"];
            if ($p_d["status_id"] == 1 && $p_d["qty"] >= $qty) {
                echo (json_encode($array));
            } else {
                echo ("Product was Deactive");
            }
        }else{
            echo("Please update your address");
        }
    } else {
        echo ("something went wromg");
    }
} else {
    echo ("signin");
}
?>