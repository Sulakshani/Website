<?php

require "connection.php";

if(isset($_GET["id"])){
    $fid=$_GET["id"];
    Database::iud("UPDATE feedback SET `m_status`=1 WHERE id='".$fid."' ");
}else{
    echo("Something Went Wromg");
}

?>