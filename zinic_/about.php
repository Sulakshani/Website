<?php

session_start();
require "connection.php";
$email;
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
}

$x=4; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZINIC | About Us</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./logoH.jpeg">

    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 960px;
            margin: auto;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #333;
        }
        p {
            color: #666;
        }
    </style>
</head>
<body>

        <?php include "header.php"; ?>

    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to <em>ZINIC Tech</em> Electronics Store, your number one source for all things electronic. We're dedicated to giving you the very best of electronic products, with a focus on quality, reliability, and customer service.</p>
        <p>Founded in 2024, Your Electronics Store has come a long way from its beginnings. When we first started out, our passion for electronics drove us to  do tons of research. so that Your Electronics Store can offer you competitive differentiator., "the world's most advanced gadgets. We now serve customers all over <strong>Sri Lanka</strong>, and are thrilled that we're able to turn our passion into our own website.</p>
        <p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
        <h2>Our Team</h2>
        <p>Meet the minds behind Your Electronics Store:</p>
        <ul>
            <li>Thishani - Developer</li>
            <li>Sulakshani - Developer</li>
            <li>Aloka - Developer</li>
            <li>Senuri - Developer</li>
            <li>Theeksahana - Developer</li>
        </ul>
    </div>


        <?php include "footer.php"; ?>

</body>
</html>
