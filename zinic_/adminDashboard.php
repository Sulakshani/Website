<?php

require "connection.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZINIC | Admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="./logoH.jpeg">
    <style>
        body{
            background-color: white;
        }
    </style>
</head>

<body <?php
        if (!isset($_SESSION["au"])) {
        ?> onload="adminSignin()" ; <?php
                                }
                                    ?>>
    <!--Signin Modal -->
    <div class="modal" tabindex="-1" id="adminSignModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Welcome to Zinic Tech Admin Panel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="adminEmail" placeholder="Enater your Email">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="sendAdminVcode();">Get Verification code</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!--Signin Modal -->
    <div class="modal" tabindex="-1" id="adminVcodeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Your Verification Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="adminVcode" placeholder="Enater your Verification Code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="CheckAdminVcode();">Sign In</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <?php
    if (isset($_SESSION["au"])) {
        $x = 1;
        include "adminHeader.php";
    ?>

        <div class="container-fluid">
            <div class="row mx-1 my-2 g-3">
                <div class="col-12 bg-body" style="height: 55px;"></div>

                <!-- Total Income , Total Engagment , Total products -->
                <div class="col-12 my-2">
                    <div class="row g-0 justify-content-center">
                        <div class="col-12 col-lg-4 d-flex flex-column align-items-center border-end border-2 border-dark">
                            <div class="card border-primary mb-3" style="max-width: 18rem;">
                                <div class="card-body text-primary">
                                    <h5 class="card-title">Total Income</h5>
                                    <?php 
                                    $total_income_rs=Database::search("SELECT SUM(qty*buy_price) AS totle FROM `invoice_item`");
                                    $total_income_d=$total_income_rs->fetch_assoc();
                                    ?>
                                    <p class="card-text">Rs: <?php echo($total_income_d["totle"]); ?>.00</p>
                                </div>
                            </div>
                            <?php include "barChart.php"; ?>
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                        <div class="col-12 col-lg-4 d-flex flex-column align-items-center border-end border-2 border-dark">
                            <div class="card border-success mb-3 " style="max-width: 18rem;">
                                <div class="card-body text-success">
                                    <h5 class="card-title text-center">Total Customers</h5>
                                    <?php
                                    $totle_customer_rs=Database::search("SELECT COUNT(*) AS totle_cus FROM user");
                                    $totle_customer_d=$totle_customer_rs->fetch_assoc();
                                    ?>
                                    <p class="card-text text-center"><?php echo($totle_customer_d["totle_cus"]) ?></p>
                                </div>
                            </div>
                            <?php include "cutomerChartProcess.php"; ?>
                        </div>
                        <div class="col-12 col-lg-4 d-flex flex-column align-items-center">
                            <div class="card border-danger mb-3" style="max-width: 18rem;">
                                <div class="card-body text-danger">
                                    <h5 class="card-title">Total Products</h5>
                                    <?php
                                    $totle_product_rs=Database::search("SELECT COUNT(*) AS totle_pro FROM product");
                                    $totle_product_d=$totle_product_rs->fetch_assoc();
                                    ?>
                                    <p class="card-text text-center"><?php echo($totle_product_d["totle_pro"]) ?></p>
                                </div>
                            </div>
                            <?php include "productChartProcess.php"; ?>
                        </div>
                    </div>
                </div>
                <!-- Total Income , Total Engagment , Total products -->
                <?php
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d");

                $separate = explode("-", $date);
                $separate2 = explode("-", $date, -1);
                $this_month = $separate2[0];
                $this_year = $separate[0];

                date_sub($d, date_interval_create_from_date_string("7 days"));
                $week_start = date_format($d, "Y-m-d");

                // catculate today income

                $today_rs = Database::search("SELECT * FROM `invoice` 
            INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id 
            WHERE `time` LIKE '" . $date . "%' ");

                $today_income = 0;
                $today_qty = 0;

                $today_num = $today_rs->num_rows;
                for ($x = 0; $x < $today_num; $x++) {
                    $today_d = $today_rs->fetch_assoc();
                    $today_income = $today_income + (int)$today_d["buy_price"] * (int)$today_d["qty"];
                    $today_qty = $today_qty + (int)$today_d["qty"];
                }

                // calculate this month and year income

                $year_rs = Database::search("SELECT * FROM `invoice` 
            INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id 
            WHERE `time` LIKE '" . $separate[0] . "%' ");

                $year_num = $year_rs->num_rows;
                $year_income = 0;
                $year_qty = 0;
                $month_income = 0;
                $month_qty = 0;
                for ($y = 0; $y < $year_num; $y++) {
                    $year_d = $year_rs->fetch_assoc();
                    $ys1 = explode(" ", $year_d["time"]); //separate invoice time to Y-m-d and H:i:s
                    $ys2 = explode("-", $ys1[0]); //separate Y-m-d in invoice time to Y,m,s

                    if ($ys2[1] == $separate[1]) {
                        $month_income = $month_income + (int)$year_d["buy_price"] * (int)$year_d["qty"];
                        $month_qty = $month_qty + (int)$year_d["qty"];
                    }

                    $year_income = $year_income + (int)$year_d["buy_price"] * (int)$year_d["qty"];
                    $year_qty = $year_qty + (int)$year_d["qty"];
                }


                // calculate this week income

                $week_income = 0;
                $week_qty = 0;

                $week_rs = Database::search("SELECT * FROM invoice 
            INNER JOIN invoice_item ON invoice.order_id=invoice_item.invoice_order_id 
            WHERE `time` BETWEEN '" . $week_start . "' AND '" . $date . "' ");

                $week_num = $week_rs->num_rows;
                for ($w = 0; $w < $week_num; $w++) {
                    $week_d = $week_rs->fetch_assoc();
                    $week_income = $week_income + (int)$week_d["buy_price"] * (int)$week_d["qty"];
                    $week_qty = $week_qty + (int)$week_d["qty"];
                }

                ?>
                <!-- today start -->
                <div class="col-12 col-md-6 col-lg-3 d-flex flex-column text-light">
                    <div class="card bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Income</div>
                        <div class="card-body">
                            <h5 class="card-title">Today Income</h5>
                            <p class="card-text">Rs. <?php echo ($today_income) ?> .00</p>
                        </div>
                    </div>

                    <div class="card bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">Sold Product</div>
                        <div class="card-body">
                            <h5 class="card-title">Today Sold Product</h5>
                            <p class="card-text"><?php echo ($today_qty) ?></p>
                        </div>
                    </div>

                    <?php
                    $today_best_rs = Database::search("SELECT * FROM invoice 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id
                INNER JOIN img ON img.product_id=invoice_item.product_id
                WHERE invoice_item.qty*invoice_item.buy_price IN 
                (SELECT MAX(invoice_item.qty*invoice_item.buy_price) FROM `invoice` 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id WHERE `time` LIKE '" . $date . "%') && `time` LIKE '" . $date . "%'  ");

                    $today_best_num = $today_best_rs->num_rows;

                    if ($today_best_num > 0) {
                        $today_best_d = $today_best_rs->fetch_assoc();
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">Today Best Sold Product</div>
                            <div class="card-body">
                                <img src="<?php echo ($today_best_d["code1"]) ?>" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. <?php echo ($today_best_d["buy_price"]) ?> .00</h6>
                                <p class="card-text text-center"><?php echo ($today_best_d["qty"]) ?> items sold</p>
                                <img src="resource/best.png" class="position-absolute top-100 start-100 translate-middle" alt="" srcset="" style="width: 40px; height: 40px; object-fit: contain;">
                            </div>
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">Today Best Sold Product</div>
                            <div class="card-body">
                                <img src="resource/no_image.png" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. ------ .00</h6>
                                <p class="card-text text-center">---- items sold</p>
                            </div>
                        </div>

                    <?php
                    }

                    ?>
                    <!-- today end -->


                    <!-- This week start -->

                </div>

                <div class="col-12 col-md-6 col-lg-3 d-flex flex-column text-light">
                    <div class="card bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Income</div>
                        <div class="card-body">
                            <h5 class="card-title">This Week Income</h5>
                            <p class="card-text">Rs. <?php echo ($week_income) ?> .00</p>
                        </div>
                    </div>

                    <div class="card bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">Sold Product</div>
                        <div class="card-body">
                            <h5 class="card-title">This week Sold Product</h5>
                            <p class="card-text"><?php echo ($week_qty) ?></p>
                        </div>
                    </div>

                    <?php
                    $today_best_rs = Database::search("SELECT * FROM invoice 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id
                INNER JOIN img ON img.product_id=invoice_item.product_id
                WHERE invoice_item.qty*invoice_item.buy_price IN 
                (SELECT MAX(invoice_item.qty*invoice_item.buy_price) FROM `invoice` 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id 
                WHERE `time` BETWEEN '" . $week_start . "' AND '" . $date . "') && `time` BETWEEN '" . $week_start . "' AND '" . $date . "' ");

                    $today_best_num = $today_best_rs->num_rows;

                    if ($today_best_num > 0) {
                        $today_best_d = $today_best_rs->fetch_assoc();
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">This week Best Sold Product</div>
                            <div class="card-body">
                                <img src="<?php echo ($today_best_d["code1"]) ?>" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. <?php echo ($today_best_d["buy_price"]) ?> .00</h6>
                                <p class="card-text text-center"><?php echo ($today_best_d["qty"]) ?> items sold</p>
                                <img src="resource/best.png" class="position-absolute top-100 start-100 translate-middle" alt="" srcset="" style="width: 40px; height: 40px; object-fit: contain;">
                            </div>
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">This week Best Sold Product</div>
                            <div class="card-body">
                                <img src="resource/no_image.png" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. ------ .00</h6>
                                <p class="card-text text-center">---- items sold</p>
                            </div>
                        </div>

                    <?php
                    }

                    ?>

                </div>

                <!-- This week end -->

                <!-- This month strat -->

                <div class="col-12 col-md-6 col-lg-3 d-flex flex-column text-light">
                    <div class="card bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Income</div>
                        <div class="card-body">
                            <h5 class="card-title">This Month Income</h5>
                            <p class="card-text">Rs. <?php echo ($month_income) ?> .00</p>
                        </div>
                    </div>

                    <div class="card bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">Sold Product</div>
                        <div class="card-body">
                            <h5 class="card-title">This Month Sold Product</h5>
                            <p class="card-text"><?php echo ($month_qty) ?></p>
                        </div>
                    </div>

                    <?php
                    $month_best_rs = Database::search("SELECT * FROM invoice 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id
                INNER JOIN img ON img.product_id=invoice_item.product_id
                WHERE invoice_item.qty*invoice_item.buy_price IN 
                (SELECT MAX(invoice_item.qty*invoice_item.buy_price) FROM `invoice` 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id WHERE `time` LIKE '" . $this_month . "%') && `time` LIKE '" . $this_month . "%'  ");

                    $month_best_num = $month_best_rs->num_rows;

                    if ($month_best_num > 0) {
                        $month_best_d = $month_best_rs->fetch_assoc();
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">This Month Best Sold Product</div>
                            <div class="card-body">
                                <img src="<?php echo ($month_best_d["code1"]) ?>" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. <?php echo ($month_best_d["buy_price"]) ?> .00</h6>
                                <p class="card-text text-center"><?php echo ($month_best_d["qty"]) ?> items sold</p>
                                <img src="resource/best.png" class="position-absolute top-100 start-100 translate-middle" alt="" srcset="" style="width: 40px; height: 40px; object-fit: contain;">
                            </div>
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">This Month Best Sold Product</div>
                            <div class="card-body">
                                <img src="resource/no_image.png" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. ------ .00</h6>
                                <p class="card-text text-center">---- items sold</p>
                            </div>
                        </div>

                    <?php
                    }

                    ?>

                </div>

                <!-- This month end -->

                <!-- This Year start -->

                <div class="col-12 col-md-6 col-lg-3 d-flex flex-column text-light">
                    <div class="card bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">Income</div>
                        <div class="card-body">
                            <h5 class="card-title">This Year Income</h5>
                            <p class="card-text">Rs. <?php echo ($year_income) ?> .00</p>
                        </div>
                    </div>

                    <div class="card bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">Sold Product</div>
                        <div class="card-body">
                            <h5 class="card-title">This Year Sold Product</h5>
                            <p class="card-text"><?php echo ($year_qty) ?></p>
                        </div>
                    </div>

                    <?php
                    $year_best_rs = Database::search("SELECT * FROM invoice 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id
                INNER JOIN img ON img.product_id=invoice_item.product_id
                WHERE invoice_item.qty*invoice_item.buy_price IN 
                (SELECT MAX(invoice_item.qty*invoice_item.buy_price) FROM `invoice` 
                INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id WHERE `time` LIKE '" . $this_year . "%') && `time` LIKE '" . $this_year . "%'  ");

                    $year_best_num = $year_best_rs->num_rows;

                    if ($year_best_num > 0) {
                        $year_best_d = $year_best_rs->fetch_assoc();
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">This Year Best Sold Product</div>
                            <div class="card-body">
                                <img src="<?php echo ($year_best_d["code1"]) ?>" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. <?php echo ($month_best_d["buy_price"]) ?> .00</h6>
                                <p class="card-text text-center"><?php echo ($year_best_d["qty"]) ?> items sold</p>
                                <img src="resource/best.png" class="position-absolute top-100 start-100 translate-middle" alt="" srcset="" style="width: 40px; height: 40px; object-fit: contain;">
                            </div>
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="card bg-body text-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">This Year Best Sold Product</div>
                            <div class="card-body">
                                <img src="resource/no_image.png" class="img-fluid img-thumbnail" alt="" srcset="" style="width: 100%; height: 200px; object-fit: contain;">
                                <h6 class="card-title text-center">Selling Price : Rs. ------ .00</h6>
                                <p class="card-text text-center">---- items sold</p>
                            </div>
                        </div>

                    <?php
                    }

                    ?>

                </div>

                <!-- This week end -->

            </div>
        </div>
    <?php
    }
    ?>
    <script src="jQuery 3.6.1.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="script.js"></script>
</body>

</html>