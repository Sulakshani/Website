<?php

require "connection.php";

if (isset($_GET["pid"])) {

    $pid = $_GET["pid"];

    $s_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $s_d = $s_rs->fetch_assoc();

    if ($s_d["status_id"] == 1) {
        Database::iud("UPDATE `product` SET `status_id`='2' WHERE id='" . $pid . "' ");

        Database::iud("DELETE FROM `cart` WHERE product_id='".$pid."'");

        echo("success");
    } else {
        Database::iud("UPDATE `product` SET `status_id`='1' WHERE id='" . $pid . "' ");
        echo("success");
    }
} else {
    echo ("something went wromg");
}
?>