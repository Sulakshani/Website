<?php

require "connection.php";
session_start();

if(isset($_GET["fee"]) && isset($_GET["id"])){
    $fee=$_GET["fee"];
    $id=$_GET["id"];

    Database::iud("UPDATE `shipping` SET `fee` ='".$fee."' WHERE id='".$id."' ");
    echo("success");
}else{
    echo("somthing went warmg");
}

?>