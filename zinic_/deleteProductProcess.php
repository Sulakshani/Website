<?php

require "connection.php";

if (isset($_GET["pid"])) {

    $pid = $_GET["pid"];

    $img_rs = Database::search("SELECT * FROM `img` WHERE `product_id`='" . $pid . "'");
    $img_d = $img_rs->fetch_assoc();
    for ($x = 0; $x < 3; $x++) {

        $y = (int)$x + 1;
        if (isset($img_d["code$y"])) {
            $status = unlink($img_d["code$y"]);
            if ($status) {
            } else {
                echo ("error");
            }
        }
    }

    Database::iud("DELETE FROM `img` WHERE `product_id`='" . $pid . "' ");
    Database::iud("DELETE FROM `cart` WHERE `product_id`='".$pid."' ");
    Database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$pid."' ");
    Database::iud("DELETE FROM `invoice_item` WHERE `product_id`='".$pid."' ");
    Database::iud("DELETE FROM `feedback` WHERE `product_id`='".$pid."' ");
    Database::iud("DELETE FROM `product` WHERE id='" . $pid . "' ");

    echo ("success");
} else {
    echo ("something went wromg");
}
?>