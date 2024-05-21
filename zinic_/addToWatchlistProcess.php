<?php

require "connection.php";
session_start();

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    if (isset($_SESSION["u"])) {
        $email = $_SESSION["u"]["email"];
        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
        $watchlist_num = $watchlist_rs->num_rows;

        if ($watchlist_num > 0) {
            Database::iud("DELETE FROM `watchlist` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "' ");
            echo ("unliked");
        } else {
            Database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`)VALUES('" . $pid . "','" . $email . "')");
            echo ("liked");
        }
    } else {
        echo ("signin");
    }
} else {
    echo ("something went wromg");
}
?>