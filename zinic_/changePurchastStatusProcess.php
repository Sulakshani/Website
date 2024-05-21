<?php

require "connection.php";

if(isset($_GET["id"])){
    $id=$_GET["id"];

    Database::iud("UPDATE invoice_item SET m_status=1 WHERE id='".$id."' ");

}else{
    echo("Something Went Wromg");
}

?>