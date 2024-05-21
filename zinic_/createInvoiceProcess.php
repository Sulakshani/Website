<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    if (isset($_POST["qty"]) && isset($_POST["oid"]) && isset($_POST["pid"])) {
        $qty = $_POST["qty"];
        $oid = $_POST["oid"];
        $pid = $_POST["pid"];

        $in_rs=Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
        $in_num=$in_rs->num_rows;

        if($in_num==0){

            $d=new DateTime();
            $tz=new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date=$d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `invoice`(`order_id`,`user_email`,`time`)
            VALUES('".$oid."','".$_SESSION["u"]["email"]."','".$date."')");

            $p_rs=Database::search("SELECT * FROM product WHERE id='".$pid."'");
            $p_d=$p_rs->fetch_assoc();
            
            Database::iud("INSERT INTO `invoice_item`(`qty`,`product_id`,`buy_price`,`invoice_order_id`)
            VALUES('".$qty."','".$pid."','".$p_d["price"]."','".$oid."')");

            (int)$quantity=$p_d["qty"];

            $quantity=$quantity-$qty;

            Database::iud("UPDATE product SET `qty`='".$quantity."' WHERE product.id='".$pid."' ");

            echo("success");

        }else{
            echo("Error");
        }

    }else{
        echo("something went wromg");
    }
} else {
    echo ("signin");
}
?>