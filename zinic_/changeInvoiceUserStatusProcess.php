<?php

if(isset($_GET["pid"]) && isset($_GET["oid"])){

    require "connection.php";
    session_start();
    $pid=$_GET["pid"];
    $oid=$_GET["oid"];

    Database::iud("UPDATE invoice_item SET u_status=0 WHERE invoice_order_id='".$oid."' && product_id='".$pid."' ");
    echo("success");

}else{
    echo("Somthing went wromg");
}

?>