<?php
session_start();
require "connection.php";

if (isset($_SESSION["au"])) {
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

    <body>

        <?php
        $x = 5;
        include "adminHeader.php";
        ?>

        <div class="container-fluid">

            <div class="row">
                <div class="col-12 bg-primary d-flex align-items-center justify-content-center" style="height: 200px;">
                    <div class="row w-100 justify-content-center">

                        <div class="col-12 col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchInvoiceByInId" onkeyup="searchByInvoice()" placeholder="Search By Invoice Id">
                                <div class="btn btn-success"><i class="bi bi-search"></i></div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="searchEmailByEmail" onkeyup="searchByEmail()" placeholder="Search By User Email">
                                <div class="btn btn-success"><i class="bi bi-search"></i></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row mx-1 my-2">
                <div class="col-12 overflow-scroll mb-2" style=" height: 100vh;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice Number</th>
                                <th>user email</th>
                                <th>Date</th>
                                <th class="text-center">status</th>
                                <th class="text-end">View</th>
                            </tr>
                        </thead>
                        <tbody id="purchasProductTable">

                            <?php


                            $in_rs = Database::search("SELECT * FROM `invoice` ORDER BY `time` DESC ");
                            $in_num = $in_rs->num_rows;
                            for ($x = 0; $x < $in_num; $x++) {
                                $in_d = $in_rs->fetch_assoc();
                            ?>

                                <tr>
                                    <td><?php echo ((int)$x + 1) ?></td>
                                    <td>
                                        <?php echo ($in_d["order_id"]) ?>
                                    </td>
                                    <td>
                                        <?php echo ($in_d["user_email"]) ?>
                                    </td>
                                    <td>
                                        <?php echo ($in_d["time"]) ?>
                                    </td>
                                    <td>
                                        <div class="d-grid">
                                            <?php
                                            if ($in_d["a_status"] == 0) {
                                            ?> <div class="btn btn-success" id="changeOrderStatusBtn<?php echo ($in_d["order_id"]) ?>" onclick="changeOrderStatus('<?php echo ($in_d['order_id']) ?>');">Comfirm Order</div><?php
                                                                                                                                                                                                                    } else if ($in_d["a_status"] == 1) {
                                                                                                                                                                                                                        ?> <div class="btn btn-primary" id="changeOrderStatusBtn<?php echo ($in_d["order_id"]) ?>" onclick="changeOrderStatus('<?php echo ($in_d['order_id']) ?>');">Couriered</div><?php
                                                                                                                                                                                                                                                                                                                                                                                                } else if ($in_d["a_status"] == 2) {
                                                                                                                                                                                                                                                                                                                                                                                                    ?> <div class="btn btn-danger disabled">Deliverd</div><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                            ?>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-end">
                                        <a href="invoice.php?order_id=<?php echo ($in_d["order_id"]) ?>" class="btn btn-primary">
                                            <i class="bi bi-eye"></i>
                                            </diav>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <script src="jQuery 3.6.1.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="chosen.jquery.js"></script>
        <script src="script.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>
<?php
}
?>