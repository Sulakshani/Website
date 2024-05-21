<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["email"]) && isset($_POST["vcode"])) {

    $email = $_POST["email"];
    $vcode = $_POST["vcode"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' && `vcode`='".$vcode."' ");
    $n = $rs->num_rows;

    if ($n == 1) {
$data=$rs->fetch_assoc();

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gayaranaweera005@gmail.com';
        $mail->Password = 'zuhmjbacfcajquqm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('gayaranaweera005@gmail.com', 'Your Password');
        $mail->addReplyTo('gayaranaweera005@gmail.com', 'Your Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'ZINIC Your Password';
        $bodyContent = '<h1 style="color:green">Your Password is ' . $data["password"] . '</h1>';
        $mail->Body    = $bodyContent;


        if (!$mail->send()) {
            echo 'Password sending failed';
        } else {
            echo ("Success");
        }
    } else {
        echo ("Invalid Verification Code");
    }
}else{
    echo("Something Went Wromg");
}
