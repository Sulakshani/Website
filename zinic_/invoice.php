<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | ZINIC</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resource/logo.svg">
</head>

<body class="mt-2" style="background-color: #f7f7ff;">
    <div class="container-fluid">
        <div class="row">

            <?php 
            require "connection.php";
            session_start();

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];
                $oid = $_GET["order_id"];
            ?>

                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i>&nbsp;Print</button>
                    <a class="btn btn-danger"><i class="bi bi-filetype-pdf"></i>&nbsp;Export as PDF</a>
                </div>

                <div class="col-12">
                    <hr />
                </div>
                <div class="col-12" id="page">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="ms-5">
                                        <img src="Zinic.png" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 150px; height: 150px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 text-decoration-underline text-end">
                                            <h2 class="text-uppercase text-success">ZINIC Teach</h2>
                                        </div>
                                        <div class="col-12 text-end fw-bold">
                                            <span class="text-uppercase"> warakapola,Kegalle ,SRI LANKA</span><br>
                                            <span>zinictech@gmail.com</span><br>
                                            <span>+94 701259526</span><br>
                                            <span>+94 701259526</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="fw-bold text-uppercase">INVOICE TO :</h5>

                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
                                    $address_data = $address_rs->fetch_assoc()
                                    ?>

                                    <h2><?php echo ($_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]); ?></h2>
                                    <span><?php echo ($address_data["line1"] . " / " . $address_data["line2"]) ?></span><br>
                                    <span><?php echo ($email); ?></span>
                                </div>

                                <?php
                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");
                                $invoice_data = $invoice_rs->fetch_assoc();
                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-success text-uppercase">invoice :<?php echo ($invoice_data["order_id"]); ?></h1>
                                    <span class="fw-bold">Data and Time Invoice :</span>
                                    <span><?php echo ($invoice_data["time"]); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">

                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Order ID and Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $in_rs = Database::search("SELECT * FROM `invoice_item` WHERE `invoice_order_id`='" . $oid . "'");
                                    $in_num = $in_rs->num_rows;
                                    $sub_totle=0;
                                    for ($x = 0; $x < $in_num; $x++) {
                                        $in_d = $in_rs->fetch_assoc();
                                        $line_totle=(int)$in_d["qty"]*(int)$in_d["buy_price"];
                                        $sub_totle=(int)$sub_totle+$line_totle;
                                    ?>
                                        <tr style="height: 72px;">
                                            <td class="bg-success text-white fs-3"><?php echo ((int)$x+1); ?></td>
                                            <td>
                                                <span class="fw-bold text-success text-decoration-underline p-2"><?php echo ($in_d["invoice_order_id"]); ?></span><br>
                                                <?php
                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $in_d["product_id"] . "' ");
                                                $product_data = $product_rs->fetch_assoc();
                                                ?>
                                                <span class="fw-bold text-success fs-4 p-2"><?php echo ($product_data["title"]); ?></span>
                                            </td>
                                            <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs. <?php echo ($in_d["buy_price"]); ?> .00</td>
                                            <td class="fw-bold fs-6 text-end"><?php echo ($in_d["qty"]); ?></td>
                                            <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs. <?php echo ($line_totle); ?> .00</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <?php

                                    $shipping_rs = Database::search("SELECT * FROM `shipping` WHERE `id`='" . $address_data["shipping_id"] . "' ");
                                    $shipping_d = $shipping_rs->fetch_assoc();

                                    ?>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo ($sub_totle); ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-success">Delivery Fee</td>
                                        <td class="text-end border-success">Rs. <?php echo ($shipping_d["fee"]); ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-success text-success">GRAND TOTAL</td>
                                        <td class="text-end border-success text-success">Rs. <?php echo ((int)$sub_totle+(int)$shipping_d["fee"]); ?> .00</td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-success">
                                Thank You !
                            </span>
                        </div>

                        <div class="col-12 border-start border-5 border-success my-3 rounded" style="background-color: #d8f3dc;">
                            <div class="row">
                                <div class="col-12 my-3">
                                    <label class="form-label fw-bold fs-5">
                                        Notice :
                                    </label><br>
                                    <label class="form-label fs-6">Purchased items can return before 7 days of delivery</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-success" />
                        </div>
                        <div class="col-12 text-center mb-3">
                            <label class="text-black-50 fw-bold fs-5 form-label">
                                Invoice was created on a computer and it is valid without the signature and seal.
                            </label>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>