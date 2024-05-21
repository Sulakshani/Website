<?php

require "connection.php";
session_start();

if (isset($_POST["msg"]) && isset($_POST["star"]) && isset($_POST["pid"])) {

    $msg = $_POST["msg"];
    $star = $_POST["star"];
    $pid = $_POST["pid"];
    $email = $_SESSION["u"]["email"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`product_id`,`user_email`,`feedback`,`star`,`time`)
VALUES('" . $pid . "','" . $email . "','" . $msg . "','" . $star . "','" . $date . "')");
    echo ("Thanks for your feedback");
} else {
    echo ("Something went wromg");
}
?>