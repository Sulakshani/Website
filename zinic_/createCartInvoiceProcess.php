<?php

session_start();
require "connection.php";
if (isset($_GET["oid"])) {
    $email = $_SESSION["u"]["email"];
    $order_id = $_GET["oid"];

    $sub_totle = 0;

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice`(`order_id`,`user_email`,`time`)
VALUES('" . $order_id . "','" . $email . "','" . $date . "')");

    $cart_rs = Database::search("SELECT * FROM cart WHERE user_email='" . $email . "'");
    $cart_num = $cart_rs->num_rows;

    for ($x = 0; $x < $cart_num; $x++) {
        $cart_d = $cart_rs->fetch_assoc();
        $p_rs = Database::search("SELECT * FROM `product` WHERE id='" . $cart_d["product_id"] . "'");
        $p_d = $p_rs->fetch_assoc();

        $line_totle = (int)$cart_d["qty"] * (int)$p_d["price"];
        $sub_totle = (int)$sub_totle + $line_totle;
        Database::iud("INSERT INTO `invoice_item`(`invoice_order_id`,`qty`,`buy_price`,`product_id`)
VALUES('" . $order_id . "','" . $cart_d["qty"] . "','" . $p_d["price"] . "','" . $p_d["id"] . "') ");

        (int)$quantity = $p_d["qty"];
        $quantity = $quantity - $cart_d["qty"];

        Database::iud("UPDATE product SET `qty`='" . $quantity . "' WHERE product.id='" . $p_d["id"] . "' ");

        Database::iud("DELETE FROM cart WHERE `id`='" . $cart_d["id"] . "'");
    }
    echo ("success");
} else {
    echo ("Something Went Wromg");
}
?>