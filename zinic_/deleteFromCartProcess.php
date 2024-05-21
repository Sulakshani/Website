<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["cid"])){

        $cid=$_GET["cid"];
    
        Database::iud("DELETE FROM cart WHERE id='".$cid."'");
    
    }else{
        echo("somthing went wromg");
    }
}else{
    echo("signin");
}

?>