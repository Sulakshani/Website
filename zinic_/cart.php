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
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="./logoH.jpeg">
        <style>
            body {
                background-color: white;
            }
        </style>
    </head>

    <body>
        <?php include "header.php"; ?>

        <div class="container-fluid my-2">
            <div class="row">
                <div class="col-12 bg-light d-flex flex-column justify-content-center align-items-center" style="height: 100px;color:black;">
                    <h2 class="fw-bold">Shopping Cart</h2>
                </div>
                <div class="col-12 my-3">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <?php
                            $sub_total = 0;
                            $total = 0;
                            $shipping = 0;

                            $cart_rs = Database::search("SELECT cart.id,cart.qty,fee,product_id FROM `cart` 
                             INNER JOIN `user` ON cart.user_email=user.email
                             INNER JOIN `shipping` ON user.shipping_id=shipping.id
                             WHERE `user_email`='" . $email . "' ");

                            $cart_num = $cart_rs->num_rows;
                            if ($cart_num > 0) {
                            ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_d = $cart_rs->fetch_assoc();

                                            $p_rs = Database::search("SELECT * FROM `product` 
                                        INNER JOIN `img` ON product.id=img.product_id
                                        INNER JOIN `brand_has_model` ON  brand_has_model.id=product.brand_has_model_id
                                        INNER JOIN brand ON brand.id=brand_has_model.brand_id
                                        INNER JOIN model ON model.id=brand_has_model.model_id
                                        WHERE product.id='" . $cart_d["product_id"] . "'");

                                            $p_d = $p_rs->fetch_assoc();

                                            $row_totle = (int)$p_d["price"] * (int)$cart_d["qty"];
                                            $sub_total = $sub_total + $row_totle;

                                            $shipping = $cart_d["fee"];
                                        ?>

                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <div>
                                                        <img src="<?php echo ($p_d["code1"]) ?>" class="img-fluid" style="width: 100px; object-fit: contain;">
                                                        <?php echo ($p_d["title"]) ?>
                                                    </div>
                                                </td>
                                                <td><?php echo ($p_d["price"]) ?></td>
                                                <td> <?php echo ($cart_d["qty"]) ?></td>
                                                <td> <?php echo ($row_totle) ?></td>
                                                <td>
                                                    <div class="btn btn-danger" onclick="deleteFromCart(<?php echo ($cart_d['id']); ?>);"><i class="bi bi-trash"></i></div>
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            <?php
                            } else {
                            ?>
                                <div class="card w-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-danger fw-bold">No items in Cart</h5>
                                        <p class="card-text">No result found</p>
                                        <a href="shop.php" class="btn btn-primary">Shop Now</a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card text-center">
                                <div class="card-header text-center">
                                    Cart Summery
                                </div>
                                <div class="card-body text-start row g-2">
                                    <p class="card-title d-flex justify-content-between"><b>Sub Total :</b><span>&nbsp;Rs. <?php echo ($sub_total); ?> .00</span></p>
                                    <p class="card-title d-flex justify-content-between"><b>Shipping :</b><span>&nbsp;Rs. <?php echo ($shipping); ?> .00</span></p>
                                    <hr class="my-2 border border-1 border-secondary bg-secondary">
                                    <p class="card-title d-flex justify-content-between"><b>Total :</b><span>&nbsp;Rs. <?php echo ($sub_total + (int)$shipping); ?> .00</span></p>
                                    <a href="checkOut.php" class="btn btn-success d-grid">Check Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>

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
    header("Location: signIn.php");
    exit;
}

?>