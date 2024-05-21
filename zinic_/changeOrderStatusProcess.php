<?php

require "connection.php";
session_start();

if (isset($_GET["oid"])) {
    $oid = $_GET["oid"];

    $in_rs = Database::search("SELECT * FROM `invoice` WHERE order_id='" . $oid . "' ");
    $in_d = $in_rs->fetch_assoc();

    $a_status = $in_d["a_status"];
    if ($a_status < 2) {
        $a_status = $a_status + 1;
    }
    Database::iud("UPDATE `invoice` SET `a_status`='" . $a_status . "' WHERE order_id='" . $oid . "'");
    echo($a_status);
}
?>