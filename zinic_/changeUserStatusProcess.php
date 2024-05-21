<?php

require "connection.php";

if(isset($_GET["email"])){
    $email=$_GET["email"];
    Database::iud("UPDATE `user` SET `m_status`=1 WHERE email='".$email."' ");
}

?>