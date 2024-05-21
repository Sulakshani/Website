<?php

require "connection.php";
session_start();

if (isset($_GET["wid"])) {

    $wid = $_GET["wid"];

    Database::iud("DELETE FROM watchlist WHERE id='" . $wid . "'");
} else {
    echo ("Something went romg");
}
?>