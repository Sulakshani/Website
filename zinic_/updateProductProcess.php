<?php

require "connection.php";

if (isset($_POST["pid"])) {

    $pid = $_POST["pid"];
    $title = $_POST["title"];
    $des = $_POST["des"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];

    $d=new DateTime();
    $tz=new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date=$d->format("Y-m-d H:i:s");

    Database::iud("UPDATE `product` SET `title`='" . $title . "',`description`='" . $des . "',`price`='" . $price . "',`qty`='" . $qty . "',`m_status`=0, 
    `upload_date`='".$date."' WHERE id='" . $pid . "' ");

    $length = sizeof($_FILES);

    for ($x = 0; $x < $length; $x++) {
        $img = $_FILES["img" . $x];
        $allow_extention = array("image/jpg", "image/png", "image/jpeg", "image/webp", "image/svg+xml");
        $img_extention = $img["type"];
        if (in_array($img_extention, $allow_extention)) {

            $new_extention;
            if ($img_extention == "image/jpg") {
                $new_extention = ".jpg";
            } else if ($img_extention == "image/png") {
                $new_extention = ".png";
            } else if ($img_extention == "image/jpeg") {
                $new_extention = ".jpeg";
            } else if ($img_extention == "image/webp") {
                $new_extention = ".webp";
            } else if ($img_extention == "image/svg+xml") {
                $new_extention = ".svg";
            }

            $new_location = "img//" . $title . "_" . $x . "_" . uniqid() . $new_extention;
            move_uploaded_file($img["tmp_name"], $new_location);

            $img_rs = Database::search("SELECT * FROM `img` WHERE `product_id`='" . $pid . "'");
            $img_d = $img_rs->fetch_assoc();

            $y = (int)$x + 1;

            if (isset($img_d["code" . $y])) {
                $status = unlink($img_d["code" . $y]);
                if ($status) {
                } else {
                    echo ("error");
                }
            }
            Database::iud("UPDATE `img` SET `code$y`='" . $new_location . "' WHERE product_id='" . $pid . "' ");
        } else {
            echo ("unsoported file");
        }
    }

    echo ("success");
} else {
    echo ("something went wromg");
}
?>