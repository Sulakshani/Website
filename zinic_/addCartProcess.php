<?php

session_start();
require "connection.php";

if (isset($_GET["pid"])) {

    $pid = $_GET["pid"];


    $q = 1;

    if (isset($_GET["qty"])) {
        (int)$q = $_GET["qty"];
    }

    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' && `user_email`='" . $email . "' ");

        $cart_num = $cart_rs->num_rows;
        $p_rs = Database::search("SELECT * FROM `product` WHERE id='" . $pid . "' ");
        $p_d = $p_rs->fetch_assoc();
        if ($p_d["status_id"] == 1) {

            if ($cart_num == 0) {

                Database::iud("INSERT INTO `cart`(`user_email`,`product_id`,`qty`)VALUES('" . $email . "','" . $pid . "','" . $q . "') ");
            } else {

                $cart_d = $cart_rs->fetch_assoc();
                (int)$qty = $cart_d["qty"];
                $qty = $qty + $q;

                Database::iud("UPDATE `cart` SET `qty`='" . $qty . "' WHERE `id`='" . $cart_d["id"] . "' ");
            }
        }
    } else {
        echo ("signin");
    }
} else {
    echo ("something went wromg");
}
?>