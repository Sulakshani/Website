<?php

require "connection.php";

$category = $_POST["category"];
$brand = $_POST["brand"];
$model = $_POST["model"];
$clr = $_POST["clr"];
$qty = $_POST["qty"];
$title = $_POST["title"];
$cost = $_POST["cost"];
$des = $_POST["des"];
$con = $_POST["condition"];

if (empty($category)) {
    echo ("Please select category");
} else if (empty($brand)) {
    echo ("Please select brand");
} else if (empty($model)) {
    echo ("Please select model");
} else if (empty($clr)) {
    echo ("Please select colour");
} else if (empty($qty)) {
    echo ("Please enter Quantity");
} else if (empty($title)) {
    echo ("Please enter title");
} else if (empty($cost)) {
    echo ("Please enter Price");
} else if (empty($des)) {
    echo ("Please Enter any description");
} else {



    $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` 
WHERE `brand_id`='" . $brand . "' && `model_id`='" . $model . "' ");

    $brand_has_model_d = $brand_has_model_rs->fetch_assoc();

    $con_rs = Database::search("SELECT * FROM `condition` WHERE `conname`='" . $con . "'");
    $con_d = $con_rs->fetch_assoc();

    $p_rs = Database::search("SELECT * FROM `product` 
WHERE `category_id`='" . $category . "' && `brand_has_model_id`='" . $brand_has_model_d["id"] . "'
&& `condition_id`='" . $con_d["id"] . "' && `colour_id`='" . $clr . "' ");

    $p_num = $p_rs->num_rows;

    $pid;

    $d=new DateTime();
    $tz=new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date=$d->format("Y-m-d H:i:s");

    if ($p_num > 0) {
        echo ("This Product Already Add");
    } else {
        Database::iud("INSERT INTO `product`(`title`,`price`,`qty`,`description`,`brand_has_model_id`,`condition_id`,`category_id`,`colour_id`,`upload_date`,`status_id`)
    VALUES('" . $title . "','" . $cost . "','" . $qty . "','" . $des . "','" . $brand_has_model_d["id"] . "','" . $con_d["id"] . "','" . $category . "','" . $clr . "','".$date."','1')");

        $pid = Database::$connection->insert_id;


        for ($x = 0; $x < sizeof($_FILES); $x++) {
            $img = $_FILES["img" . $x];

            $allow_file_type = array("image/png", "image/jpg", "image/jpeg", "image/webp", "image/svg+xml");
            $img_extention = $img["type"];

            if (in_array($img_extention, $allow_file_type)) {
                $new_img_extention;
                if ($img_extention == "image/png") {
                    $new_img_extention = ".png";
                } else if ($img_extention == "image/jpg") {
                    $new_img_extention = ".jpg";
                } else if ($img_extention == "image/jpeg") {
                    $new_img_extention = ".jpeg";
                } else if ($img_extention == "image/webp") {
                    $new_img_extention = ".webp";
                } else if ($img_extention == "image/svg+xml") {
                    $new_img_extention = ".svg";
                }

                $new_location = "img//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;

                move_uploaded_file($img["tmp_name"], $new_location);

                $img_rs = Database::search("SELECT * FROM `img` WHERE `product_id`='" . $pid . "'");

                $img_num = $img_rs->num_rows;

                $y = (int)$x + 1;

                if ($img_num == 0) {
                    Database::iud("INSERT INTO `img`(`code$y`,`product_id`)VALUES('" . $new_location . "','" . $pid . "')");
                } else {
                    Database::iud("UPDATE `img` SET `code$y`='" . $new_location . "' WHERE `product_id`='" . $pid . "' ");
                }
            } else {
                echo ("Invalid file type");
            }
        }
    }
}
?>