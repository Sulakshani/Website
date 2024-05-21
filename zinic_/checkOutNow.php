<?php
require "connection.php";
session_start();
if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ZINIC | cart</title>
        <link rel="stylesheet" href="chosen.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="Zinic_icon.png">
    </head>

    <body>
        <?php include "header.php"; ?>

        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-12 bg-primary d-flex flex-column justify-content-center align-items-center" style="height: 200px;">
                    <h2 class="fw-bold">Check Out</h2>
                    <ol class="breadcrumb justify-content-center fs-5 fw-bold">
                        <a href="index.php" class="text-decoration-none text-dark">
                            <li>Home</li>
                        </a>
                        <li>&nbsp;-&nbsp;</li>
                        <li>Check Out</li>
                    </ol>
                </div>
                <div class="col-12 my-3">
                    <div class="row">
                        <div class="col-12 col-lg-8 mb-2">
                            <div class="row g-2">

                                <div class="col-6">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" value="<?php echo ($u_d["fname"]); ?>">
                                </div>
                                <div class="col-6">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" value="<?php echo ($u_d["lname"]); ?>">
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" readonly value="<?php echo ($u_d["email"]); ?>">
                                </div>
                                <div class="col-12">
                                    <label for="mobile1" class="form-label">Mobile Number 1</label>
                                    <input type="text" class="form-control" id="mobile1" readonly value="<?php echo ($u_d["mobile1"]); ?>">
                                </div>
                                <div class="col-12">
                                    <label for="mobile2" class="form-label">Mobile Number 2 (optional)</label>
                                    <input type="text" class="form-control" id="mobile2" value="<?php if (isset($u_d["mobile2"])) {
                                                                                                    echo ($u_d["mobile2"]);
                                                                                                } ?>">
                                </div>
                                <div class="col-12">
                                    <label for="line1" class="form-label">Address Line 1</label>
                                    <input type="text" class="form-control" id="line1" value="<?php if (isset($u_d["line1"])) {
                                                                                                    echo ($u_d["line1"]);
                                                                                                } ?>">
                                </div>
                                <div class="col-12">
                                    <label for="line2" class="form-label">Address Line 2 (optional)</label>
                                    <input type="text" class="form-control" id="line2" value="<?php if (isset($u_d["line2"])) {
                                                                                                    echo ($u_d["line2"]);
                                                                                                } ?>">
                                </div>
                                <div class="col-12">
                                    <label for="pcode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="pcode" value="<?php if (isset($u_d["pcode"])) {
                                                                                                    echo ($u_d["pcode"]);
                                                                                                } ?>">
                                </div>

                            </div>
                        </div>

                        <?php
                        $cart_rs=Database::search("SELECT * FROM `cart` 
                        INNER JOIN `product` ON cart.product_id=product.id 
                        WHERE `user_email`='".$email."'");
                        ?>

                        <div class="col-12 col-lg-4 mb-2">
                            <div class="card text-center">
                                <div class="card-header text-center">
                                    Summery
                                </div>
                                <div class="card-body text-start row g-2">
                                    <p class="card-title d-flex justify-content-between"><b>Sub Total :</b><span>&nbsp;Rs. 120000 .00</span></p>
                                    <p class="card-title d-flex justify-content-between"><b>Shipping :</b><span>&nbsp;Rs. 1000 .00</span></p>
                                    <hr class="my-2 border border-1 border-secondary bg-secondary">
                                    <p class="card-title d-flex justify-content-between"><b>Total :</b><span>&nbsp;Rs. 121000 .00</span></p>
                                    <div class="btn btn-success d-grid">Place Order</div>
                                </div>
                            </div>
                        </div>
                    </div>
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
} else {
    header("Location: index.php");
    exit;
}
?>