<?php

require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mob2 = $_POST["mob2"];
    $line1 = $_POST["line1"];
    $line2 = $_POST["line2"];
    $dist_id = $_POST["dist"];
    $pcode = $_POST["pcode"];
    if (isset($_FILES["i"])) {
        $img = $_FILES["i"];

        $i_name = $img["name"];

        $file_arr = explode('.', $i_name);
        $file_type = $file_arr[1];

        $file_new_name = "profile_pic/propic_" . uniqid() . "_" . $fname . "." . $file_type;
        move_uploaded_file($img["tmp_name"], $file_new_name);
        Database::iud("UPDATE user SET `profile_pic`='$file_new_name' WHERE `email`='$email' ");
    }

    Database::iud("UPDATE user SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile2`='" . $mob2 . "',
    `line1`='" . $line1 . "',`line2`='" . $line2 . "',`shipping_id`='" . $dist_id . "',`pcode`='" . $pcode . "' WHERE email='" . $email . "' ");
    echo ("success");
} else {
    echo ("signin");
}
?>