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
    <title>ZINIC | Products View</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="Zinic_icon.png">
</head>

<body>

    <?php include "header.php"; ?>

    <div class="container-fluid">

        <?php

        $cat_rs = Database::search("SELECT * FROM `category`");
        $cat_num = $cat_rs->num_rows;

        for ($c = 0; $c < $cat_num; $c++) {
            $cat_d = $cat_rs->fetch_assoc();

            $brand_rs = Database::search("SELECT * FROM `brand` ORDER BY `bname`");
            $brand_num = $brand_rs->num_rows;
            for ($x = 0; $x < $brand_num; $x++) {
                $brand_d = $brand_rs->fetch_assoc();

                $model_rs = Database::search("SELECT DISTINCT `mname`, model.id FROM `brand_has_model` 
            INNER JOIN `model` ON brand_has_model.model_id=model.id
            INNER JOIN product ON  brand_has_model.id=product.brand_has_model_id
            WHERE brand_has_model.brand_id='" . $brand_d["id"] . "' && product.category_id='" . $cat_d["id"] . "' ORDER BY `mname` ");

                $model_num = $model_rs->num_rows;
                for ($y = 0; $y < $model_num; $y++) {
                    $model_d = $model_rs->fetch_assoc();

        ?>
                    <div class="row justify-content-center gap-2">
                        <h3 id="productsView_<?php echo ($brand_d["bname"] . "_" . $model_d["mname"]) ?>"><?php echo ($model_d["mname"]) ?></h3>
                        <hr class="border border-1 border-success bg-success" />

                        <?php
                        $p_rs = Database::search("SELECT * FROM `brand_has_model` 
                INNER JOIN `product` ON brand_has_model.id=product.brand_has_model_id 
                INNER JOIN `img` ON product.id=img.product_id
                WHERE model_id='" . $model_d["id"] . "' && brand_id='" . $brand_d["id"] . "' && status_id=1 ORDER BY `title` ");
                        $p_num = $p_rs->num_rows;

                        for ($z = 0; $z < $p_num; $z++) {
                            $p_d = $p_rs->fetch_assoc();
                        ?>

                            <div class="card" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo ($p_d["description"]); ?>" title="<?php echo ($p_d["title"]); ?>" style="width: 250px;">
                                <img src="<?php echo ($p_d["code1"]) ?>" class="card-img-top img-fluid img-thumbnail mx-auto" style="width: 200px; height: 200px; object-fit: contain;" />
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo ($p_d["title"]) ?></h5>
                                    <div class="row d-grid g-1">
                                        <?php if ($p_d["qty"] > 0) {
                                        ?>
                                            <a href="singleProductView.php?pid=<?php echo ($p_d["id"]) ?>" class="btn btn-danger"><i class="bi bi-cash"></i> Buy Now</a>
                                            <a class="btn btn-success" onclick="addToCart(<?php echo ($p_d['id']) ?>)"><i class="bi bi-cart"></i> Add to cart</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a  class="btn btn-danger disabled"><i class="bi bi-cash"></i> Buy Now</a>
                                            <a class="btn btn-success disabled"><i class="bi bi-cart"></i> Add to cart</a>
                                        <?php
                                        }
                                        $watchlist_num = 0;
                                        if (isset($_SESSION["u"])) {
                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'&& `product_id`='" . $p_d["id"] . "' ");
                                            $watchlist_num = $watchlist_rs->num_rows;
                                        }
                                        ?>
                                        <a class="btn btn-light watchlist<?php echo ($p_d['id']) ?>" onclick="addToWatchlist(<?php echo ($p_d['id']) ?>)"><i class="bi bi-heart-fill <?php
                                                                                                                                                                                    if ($watchlist_num > 0) {
                                                                                                                                                                                    ?>text-danger<?php
                                                                                                                                                                                    }
                                                                                                                                                                    ?>"></i> Add to Watchlist</a>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                        ?>

                        <hr class="border border-1 border-success bg-success mt-2" />
                    </div>
                <?php

                }
                ?>

        <?php
            }
        }

        ?>

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