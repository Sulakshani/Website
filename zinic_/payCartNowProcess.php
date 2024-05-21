<?php
require "connection.php";
session_start();
$email=$_SESSION["u"]["email"];

$order_id = uniqid();

$cart_rs=Database::search("SELECT cart.qty AS cqty,product.price,status_id,product.qty AS pqty FROM `cart` 
INNER JOIN product ON cart.product_id=product.id WHERE user_email='".$email."'");
$cart_num=$cart_rs->num_rows;
$amount=0;
$checker=0;
for($x=0;$x<$cart_num;$x++){
    $cart_d=$cart_rs->fetch_assoc();

    $line_totle=(int)$cart_d["price"]*(int)$cart_d["cqty"];
    $amount=$amount+$line_totle;

    if($cart_d["status_id"]==2 || $cart_d["pqty"]<$cart_d["cqty"]){
        $checker=1;
    }
}

$u_rs=Database::search("SELECT * FROM user INNER JOIN shipping ON user.shipping_id=shipping.id WHERE `email`='".$email."'");
$u_d=$u_rs->fetch_assoc();

$array;

        $array["fname"]=$u_d["fname"];
        $array["lname"]=$u_d["lname"];
        $array["mobile"]=$u_d["mobile1"];
        $array["email"]=$u_d["email"];
        $array["district"]=$u_d["district"];
        $array["address"]=$u_d["line1"]." / ".$u_d["line2"];
        $array["oid"]=$order_id;

        $array["amount"]=$amount;

       if(!empty($u_d["line1"]) || !empty($u_d["line2"])){
        if($checker==0){
            echo(json_encode($array));
           }else{
            echo("There was deactive product");
           }
       }else{
        echo("Please update your address");
       }

?>