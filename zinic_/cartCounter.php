<?php

require "connection.php";
session_start();

if (isset($_SESSION["u"])) {

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
    $cart_num = $cart_rs->num_rows;
    
    $watchlist_rs=Database::search("SELECT * FROM watchlist WHERE user_email='".$_SESSION["u"]["email"]."'");
    $watchlist_num=$watchlist_rs->num_rows;

    $array;
    $array["cart_num"]=$cart_num;
    $array["watchlist_num"]=$watchlist_num;

    echo(json_encode($array));
}
?>