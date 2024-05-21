<?php

require "connection.php";

if (isset($_GET["cat"])) {

    $cat_rs = Database::search("SELECT * FROM `category` WHERE `catname`='" . $_GET["cat"] . "' ");
    $cat_num = $cat_rs->num_rows;
    if ($cat_num == 0) {
        Database::iud("INSERT INTO `category`(`catname`)VALUES('" . $_GET["cat"] . "') ");
        echo ("Success");
    } else {
        echo ("added");
    }
}

if (isset($_GET["brand"])) {
    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `bname`='" . $_GET["brand"] . "' ");
    $brand_num = $brand_rs->num_rows;
    if ($brand_num == 0) {
        Database::iud("INSERT INTO `brand`(`bname`)VALUES('" . $_GET["brand"] . "') ");
        echo ("Success");
    } else {
        echo ("added");
    }
}

if (isset($_GET["model"])) {
    $mod_rs = Database::search("SELECT * FROM `model` WHERE `mname`='" . $_GET["model"] . "' ");
    $mod_num = $mod_rs->num_rows;
    if ($mod_num == 0) {
        Database::iud("INSERT INTO `model`(`mname`)VALUES('" . $_GET["model"] . "') ");
        $mod_id = Database::$connection->insert_id;

        Database::iud("INSERT INTO `brand_has_model`(`brand_id`,`model_id`)VALUES('" . $_GET["bid"] . "','" . $mod_id . "') ");

        echo ("Success");
    } else {
        echo ("added");
    }
}

if (isset($_GET["clr"])) {
    $clt_rs = Database::search("SELECT * FROM `colour` WHERE `colour`='" . $_GET["clr"] . "' ");
    $clr_num = $clt_rs->num_rows;
    if ($clr_num == 0) {
        Database::iud("INSERT INTO `colour`(`colour`)VALUES('" . $_GET["clr"] . "') ");
        echo ("Success");
    } else {
        echo ("added");
    }
}
?>