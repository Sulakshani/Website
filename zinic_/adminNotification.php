<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZINIC | Admin Notification</title>
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

<body>

    <?php
    $x = 7;
    include "adminHeader.php";
    ?>

    <div class="container-fluid">
        <div class="row fw-bold mb-3">

            <div class="col-12" style="height: 55px;"></div>

            <div class="col-12 bg-primary d-flex justify-content-center align-items-center flex-column" style="height: 200px;">
                <h3 class="fw-bold">Admin Notification</h3>
                <ol class="breadcrumb">
                    <a href="adminDashboard.php" class="text-decoration-none text-dark">
                        <li>Dashboard</li>
                    </a>
                    <li>&nbsp;-&nbsp;</li>
                    <li>Notification</li>
                </ol>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <?php
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $today = $d->format("Y-m-d H:i:s");
            $d->setTimezone($tz);
            date_sub($d, date_interval_create_from_date_string("7 days"));
            $week_start = date_format($d, "Y-m-d H:i:s");

            ?>

            <div class="col-12">
                <div class="row overflow-scroll" style="max-height: 75vh;">
                    <h3>New Connections In This Week</h3>

                    <?php
                    #new connections
                    $newc_rs = Database::search("SELECT * FROM `user` WHERE `time` > '" . $week_start . "' ");
                    $newc_num = $newc_rs->num_rows;
                    for ($x = 0; $x < $newc_num; $x++) {
                        $newc_d = $newc_rs->fetch_assoc();
                        if ($newc_d["m_status"] == 0) {
                    ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert" style="height: 75px;" onclick="changeUserStatus('<?php echo ($newc_d['email']) ?>');">
                                <i class="bi bi-person-check-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo ($newc_d["email"]) ?> is joined
                                    <br>
                                    <?php echo ($newc_d["time"]) ?>
                                </div>
                                <span class="badge bg-primary rounded-circle ms-auto" id="changeUserStatus<?php echo($newc_d['email']) ?>">&nbsp;</span>
                            </div>
                    <?php
                        }else{
                            ?>
                            <div class="alert alert-primary d-flex align-items-center" role="alert" style="height: 75px;");">
                                <i class="bi bi-person-check-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo ($newc_d["email"]) ?> is joined
                                    <br>
                                    <?php echo ($newc_d["time"]) ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row overflow-scroll" style="max-height: 75vh;">
                    <h3>Add And Update Product In This Week</h3>

                    <?php
                    #new added or updated product
                    $newp_rs = Database::search("SELECT * FROM `product` WHERE `upload_date`> '" . $week_start . "' ");
                    $newp_num = $newp_rs->num_rows;
                    for ($x = 0; $x < $newp_num; $x++) {
                        $newp_d = $newp_rs->fetch_assoc();
                        if ($newp_d["m_status"] == 0) {
                    ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert" style="height: 75px;" onclick="changeProductStatus('<?php echo ($newp_d['id']) ?>');">
                                <i class="bi bi-check-circle-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo($newp_d["title"]); ?> Update Success
                                    <br>
                                    <?php echo ($newp_d["upload_date"]) ?>
                                </div>
                                <span class="badge bg-success rounded-circle ms-auto" id="changeProductStatus<?php echo($newp_d['id']) ?>">&nbsp;</span>
                            </div>
                    <?php
                        }else{
                            ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert" style="height: 75px;">
                                <i class="bi bi-check-circle-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo($newp_d["title"]); ?> Update Success
                                    <br>
                                    <?php echo ($newp_d["upload_date"]) ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row overflow-scroll" style="max-height: 75vh;">
                    <h3>Purchased Product In This Week</h3>

                    <?php
                    $purchas_rs = Database::search("SELECT invoice.order_id,invoice.user_email,product.title,invoice.time,invoice_item.m_status,invoice_item.id FROM `invoice`
INNER JOIN invoice_item ON invoice.order_id=invoice_order_id 
INNER JOIN product ON product_id=product.id WHERE invoice.time  > '" . $week_start . "' ");
                    $purchas_num = $purchas_rs->num_rows;
                    for ($x = 0; $x < $purchas_num; $x++) {
                        $purchas_d = $purchas_rs->fetch_assoc();
                        if ($purchas_d["m_status"] == 0) {
                    ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 75px;" onclick="changePurchastStatus('<?php echo ($purchas_d['id']) ?>');">
                                <i class="bi bi-piggy-bank-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo ($purchas_d["user_email"]) ?> is bought <?php echo ($purchas_d["title"]) ?>
                                    <br>
                                    <?php echo ($purchas_d["time"]) ?>
                                </div>
                                <span class="badge bg-danger rounded-circle ms-auto" id="changePurchastStatus<?php echo ($purchas_d['id']) ?>">&nbsp;</span>
                            </div>
                    <?php
                        }else{
                            ?>
                             <div class="alert alert-danger d-flex align-items-center" role="alert" style="height: 75px;">
                                <i class="bi bi-piggy-bank-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo ($purchas_d["user_email"]) ?> is bought <?php echo ($purchas_d["title"]) ?>
                                    <br>
                                    <?php echo ($purchas_d["time"]) ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row overflow-scroll" style="max-height: 75vh;">
                    <h3>feedback In This Week</h3>
                    <?php
                    $feedback_rs = Database::search("SELECT feedback.id,user_email,`time`,title,feedback.m_status FROM feedback INNER JOIN product On product_id=product.id WHERE `time`  > '" . $week_start . "' ");
                    $feedback_num = $feedback_rs->num_rows;
                    for ($x = 0; $x < $feedback_num; $x++) {
                        $feedback_d = $feedback_rs->fetch_assoc();
                        if ($feedback_d["m_status"] == 0) {
                    ?>
                            <div class="alert alert-warning d-flex align-items-center" role="alert" style="height: 75px;" onclick="changeFeedbacktStatus('<?php echo ($feedback_d['id']) ?>');">
                                <i class="bi bi-chat-dots-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo ($feedback_d["user_email"]) ?> is comment on <?php echo ($feedback_d["title"]) ?>
                                    <br>
                                    <?php echo ($feedback_d["time"]) ?>
                                </div>
                                <span class="badge bg-warning rounded-circle ms-auto" id="changeFeedbacktStatus<?php echo($feedback_d["id"]) ?>">&nbsp;</span>
                            </div>
                    <?php
                        }else{
                            ?>
                            <div class="alert alert-warning d-flex align-items-center" role="alert" style="height: 75px;">
                                <i class="bi bi-chat-dots-fill flex-shrink-0 me-4 fs-3"></i>
                                <div>
                                    <?php echo ($feedback_d["user_email"]) ?> is comment on <?php echo ($feedback_d["title"]) ?>
                                    <br>
                                    <?php echo ($feedback_d["time"]) ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="jQuery 3.6.1.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>