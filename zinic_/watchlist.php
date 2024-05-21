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
        <title>ZINIC | watchlist</title>
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="./logoH.jpeg">
    </head>

    <body>
        <?php include "header.php"; ?>

        <div class="container-fluid my-2">
            <div class="row bg-light" style="height: 100px;">
                <div class="col-12 d-flex flex-column align-items-center justify-content-center fw-bold">
                    <h2 class="text-center fw-bold">My Watchlist</h2>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 col-lg-8">

                    <?php
                    $watchlist_rs = Database::search("SELECT code1,title,price,qty,watchlist.product_id,watchlist.id FROM `watchlist` 
                INNER JOIN product ON product.id=watchlist.product_id 
                INNER JOIN img ON img.product_id=product.id 
                WHERE user_email='" . $email . "' && status_id=1 ");

                    $watchlist_num = $watchlist_rs->num_rows;

                    if ($watchlist_num > 0) {
                        for ($x = 0; $x < $watchlist_num; $x++) {
                            $watchlist_d = $watchlist_rs->fetch_assoc();
                    ?>

                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        <img src="<?php echo ($watchlist_d["code1"]) ?>" class="img-fluid rounded-start w-100" style="object-fit: contain;">
                                    </div>
                                    <div class="col-6 my-auto">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo ($watchlist_d["title"]) ?></h5>
                                            <span class="card-text"><b>Price :</b>&nbsp;Rs. <?php echo ($watchlist_d["price"]) ?> .00</span><br>
                                            <span class="card-text"><b>In stock :</b>&nbsp; <?php echo ($watchlist_d["qty"]) ?> <small>items available</small></span>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex flex-column justify-content-center align-items-center gap-1">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Buy Now">
                                            <a href="singleProductView.php?pid=<?php echo ($watchlist_d["product_id"]) ?>" class="btn btn-primary" title="Buy Now"><i class="bi bi-coin"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Add to Cart">
                                            <a class="btn btn-success" title="Add to Cart" onclick="addToCart(<?php echo ($watchlist_d['product_id']); ?>)"><i class="bi bi-cart"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Remove form Watchlist">
                                            <div class="btn btn-danger" title="Remove Form Watchlist" onclick="removeFromWatchlist(<?php echo($watchlist_d['id']) ?>);"><i class="bi bi-trash"></i></div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                    } else {

                        ?>

                        <div class="card w-100">
                            <div class="card-body text-center">
                                <h5 class="card-title text-danger fw-bold">No items in watchlist</h5>
                                <p class="card-text">No result found</p>
                                <a href="shop.php" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>

                    <?php

                    } ?>




                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>

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
    header("Location: signIn.php");
    exit;
}
?>