<?php
require "connection.php";
session_start();

if (isset($_SESSION["au"])) {

    if (isset($_GET["u_email"])) {

        $u_email = $_GET["u_email"];
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ZINIC | Admin User Product</title>
            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css">
            <link rel="icon" href="./logoH.jpeg">
        </head>

        <body>

            <div class="container-fluid">
                <div class="row fw-bold">
                    <div class="col-12 bg-primary d-flex justify-content-center align-items-center flex-column" style="height: 200px;">
                        <h3 class="fw-bold">User Details</h3>
                        <ol class="breadcrumb">
                            <a href="adminDashboard.php" class="text-decoration-none text-dark">
                                <li>Dashboard</li>
                            </a>
                            <li>&nbsp;-&nbsp;</li>
                            <li>User Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <?php
            $user_rs = Database::search("SELECT * FROM user WHERE email='" . $u_email . "'");
            $user_d = $user_rs->fetch_assoc();
            ?>

            <div class="container-fluid">
                <div class="row my-2">
                    <div class="col-12 col-lg-6">
                        <div class="row g-2">
                            <h3>User Profile</h3>
                            <div class="col-6">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["fname"]) ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["lname"]) ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["email"]) ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Mobile 1</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["mobile1"]) ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Mobile 2</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["mobile2"]) ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Address Line 1</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["line1"]) ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["line2"]) ?>" readonly>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" value="<?php echo ($user_d["pcode"]) ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="row g-2 overflow-scroll h-100">
                            <h3>User Purchase History</h3>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Id</th>
                                        <th>Purchase Price</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <?php
                                $in_rs = Database::search("SELECT * FROM invoice 
                        INNER JOIN invoice_item ON invoice.order_id=invoice_item.invoice_order_id
                        WHERE user_email='" . $u_email . "' ORDER BY `time` DESC ");

                                $in_num = $in_rs->num_rows;
                                ?>

                                <tbody>

                                    <?php
                                    for ($x = 0; $x < $in_num; $x++) {
                                        $in_d = $in_rs->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo ((int)$x + 1) ?></td>
                                            <td><?php echo ($in_d["product_id"]) ?></td>
                                            <td><?php echo ($in_d["buy_price"]) ?></td>
                                            <td><?php echo ($in_d["qty"]) ?></td>
                                            <td><?php echo ($in_d["time"]) ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
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
<?php
    } else {
        header("Location: adminManageUser.php");
        exit;
    }
}else{
    echo("Your are not a admin");
}
?>