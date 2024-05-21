<?php

require "connection.php";

if(isset($_GET["pid"])){
    $pid=$_GET["pid"];

    Database::iud("UPDATE product SET m_status=1 WHERE id='".$pid."' ");

}else{
    echo("Something went wromg");
}

?>