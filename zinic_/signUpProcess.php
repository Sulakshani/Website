<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$mob1 = $_POST["mob1"];
$pw = $_POST["pw"];
$dis_id=$_POST["dis"];

if (empty($fname)) {
    echo ("Please enter your first name");
} else if (empty($lname)) {
    echo ("Please enter your last name");
} else if (empty($email)) {
    echo ("Please enter your email");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 charactors");
} else if (empty($mob1)) {
    echo ("Please enter your mobile");
} else if (strlen($mob1) != 10) {
    echo ("Mobile must have 10 charactors");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mob1)) {
    echo ("Invalid Mobile");
} else if (empty($pw)) {
    echo ("Please enter your password");
} else if (strlen($pw) < 5 || strlen($pw) > 20) {
    echo ("Password Must Have between 5-20 charactor");
} else {

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' || `mobile1`='" . $mob1 . "' || `mobile2`='" . $mob1 . "' ");

    $user_num = $user_rs->num_rows;
    if ($user_num == 0) {

        $d=new DateTime();
        $tz=new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date=$d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`mobile1`,`shipping_id`,`time`)
    VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $pw . "','" . $mob1 . "','".$dis_id."','".$date."')");

        setcookie("u_email", $email);
        setcookie("u_pw", $pw);

        echo ("success");
    } else {
        echo ("Email or Mobile already exit");
    }
}
?>