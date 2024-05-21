<?php

require "connection.php";
session_start();
if (isset($_GET["pid"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ZINIC | Single Product View</title>
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="./logoH.jpeg">
    </head>

    <body>

        <?php include "header.php"; ?>

        <?php

        $pid = $_GET["pid"];
        $p_rs = Database::search("SELECT * FROM `product` 
        INNER JOIN `img` ON product.id=img.product_id 
        INNER JOIN `brand_has_model` ON brand_has_model.id=product.brand_has_model_id
        INNER JOIN `brand` ON brand.id=brand_has_model.brand_id
        INNER JOIN `model` ON model.id=brand_has_model.model_id
        INNER JOIN `condition` ON condition.id=product.condition_id
        INNER JOIN `colour` ON colour.id=product.colour_id
        WHERE product.id='" . $pid . "' ");
        $p_d = $p_rs->fetch_assoc();

        ?>

        <div class="container-fluid my-2">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-3">

                            <?php
                            for ($x = 1; $x <= 3; $x++) {

                                if (isset($p_d["code$x"])) {
                            ?>
                                    <img src="<?php echo ($p_d["code$x"]) ?>" onclick='changeSingleProductImg(<?php echo ($x); ?>)' class="img-fluid img-thumbnail" id="imgView<?php echo ($x) ?>" style="width: 100%;height: 166.66px; object-fit:cover ;">
                                <?php
                                } else {
                                ?>
                                    <img src="resource/no_image.png" alt="" class="img-fluid img-thumbnail" style="width: 100%;height: 166.66px; object-fit:cover ;">
                            <?php
                                }
                            }
                            ?>

                        </div>
                        <div class="col-9">
                            <img src="<?php echo ($p_d["code1"]) ?>" alt="" class="img-fluid img-thumbnail" id="mainImg" style="width: 100%;height: 500px; object-fit:cover ;">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card text-center">
                        <div class="card-header">
                            <?php echo ($p_d["title"]) ?>
                        </div>
                        <div class="card-body text-start">
                            <h5 class="card-title"><?php echo ($p_d["title"]) ?></h5>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <span><span class="fw-bold">Price :</span>&nbsp; Rs. <?php echo ($p_d["price"]) ?> .00</span>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <span><span class="fw-bold">In stock :</span>&nbsp;<span id="availableQty"><?php echo ($p_d["qty"]) ?></span>&nbsp;<small>items available</small></span>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <span><span class="fw-bold">Condition :</span>&nbsp; <?php echo ($p_d["conname"]) ?> </span>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <span><span class="fw-bold">Colour :</span>&nbsp; <?php echo ($p_d["colour"]) ?></span>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <span><strong>Seller :</strong>&nbsp;Gaya</span>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <br>
                            <label for="" class="form-label">Add Quantity</label>
                            <div class="row justify-content-center input-group">
                                <div class="col-1 btn btn-primary" id="removeQuantitySingleProductView" onclick="removeQuantity();">
                                    <i class="bi bi-dash"></i>
                                </div>
                                <div class="col-4 p-0">
                                    <input type="text" class="form-control rounded-0" id="productQuantitySingleProductView" readonly value="1" />
                                </div>
                                <div class="col-1 btn btn-primary" id="addQuantitySingleProductView">
                                    <i class="bi bi-plus"></i>
                                </div>
                            </div>
                            <br>
                            <hr class="border border-1 border-secondary bg-secondary my-2" />
                            <?php
                            $pro_rs = Database::search("SELECT * FROM `product` WHERE id='" . $pid . "' ");
                            $pro_d = $pro_rs->fetch_assoc();
                            ?>
                            <div class="row justify-content-center g-1">
                                <div class="col-12 col-lg-4 d-grid">
                                    <button type="submit" id="payhere-payment" <?php
                                                                                if ($pro_d["qty"] > 0 && $pro_d["status_id"]==1) {
                                                                                ?> class="btn btn-danger" onclick="payNow(<?php echo ($pid); ?>);" <?php
                                                                                                                                                } else {
                                                                                                                                                    ?> class="btn btn-danger disabled" <?php
                                                                                                                                                                                    }
                                                                                                                                                                                        ?>>Buy Now</button>
                                </div>
                                <div class="col-12 col-lg-4 d-grid">
                                    <button <?php
                                            if ($pro_d["qty"] > 0 && $pro_d["status_id"]==1) {
                                            ?> class="btn btn-success" onclick="addToCartSingleProduct(<?php echo ($pid); ?>);" <?php
                                                                                                                            } else {
                                                                                                                                ?> class="btn btn-success disabled" <?php
                                                                                                                                                                }
                                                                                                                                                                    ?>><i class="bi bi-cart"></i> Add to Cart</button>
                                </div>
                                <div class="col-12 col-lg-4 d-grid">
                                    <?php
                                    $watchlist_num = 0;
                                    if (isset($_SESSION["u"])) {
                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` 
                                        WHERE `user_email`='" . $_SESSION["u"]["email"] . "' && `product_id`='" . $pid . "' ");
                                        $watchlist_num = $watchlist_rs->num_rows;
                                    }
                                    ?>
                                    <button class="btn btn-light watchlist<?php echo($pid) ?>" onclick="addToWatchlist(<?php echo ($pid); ?>);"><i class="bi bi-heart-fill <?php
                                                                                                                                                if ($watchlist_num > 0) {
                                                                                                                                                ?>text-danger<?php
                                                                                                                                                            }
                                                                                                                                                                ?>"></i> Add to Watchlist</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Items -->

                <div class="col-12 my-3">
                    <h4>Related Items</h4>
                    <hr class="border border-1 border-primary bg-primary" />
                    <div class="row gap-2 justify-content-center">

                        <?php

                        $related_rs = Database::search("SELECT * FROM `product`
                        INNER JOIN `img` ON product.id=img.product_id
                        WHERE brand_has_model_id='" . $p_d["brand_has_model_id"] . "' && product.id != '" . $pid . "' LIMIT 5 ");
                        $related_num = $related_rs->num_rows;
                        for ($x = 0; $x < $related_num; $x++) {
                            $related_d = $related_rs->fetch_assoc();

                            $w_num = 0;
                            if (isset($_SESSION["u"])) {
                                $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $related_d["id"] . "' && `user_email`='" . $_SESSION["u"]["email"] . "' ");
                                $w_num = $w_rs->num_rows;
                            }
                        ?>

                            <div class="card" style="width: 250px;">
                                <img src="<?php echo ($related_d["code1"]); ?>" class="card-img-top img-fluid img-thumbnail" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo ($related_d["title"]); ?></h5>
                                    <div class="row d-grid g-1">
                                        <a href="singleProductView.php?pid=<?php echo ($related_d['product_id']); ?>" class="btn btn-danger"><i class="bi bi-"></i> Buy Now</a>
                                        <a class="btn btn-success" onclick="addToCart(<?php echo ($related_d['product_id']); ?>);"><i class="bi bi-cart"></i> Add to cart</a>
                                        <a class="btn btn-light" onclick="addToWatchlist(<?php echo ($related_d['product_id']); ?>);"><i class="bi bi-heart-fill <?php
                                                                                                                                                                    if ($w_num > 0) {
                                                                                                                                                                    ?>text-danger<?php
                                                                                                                                                                                }
                                                                                                                                                                                    ?>"></i> Add to Watchlist</a>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                    <hr class="border border-1 border-primary bg-primary mt-2" />
                </div>

                <div class="col-12 col-lg-6 my-2">
                    <div class="row g-3 justify-content-center">
                        <h4>Product details</h4>
                        <div class="col-6">
                            <strong>Brand :</strong>&nbsp;<?php echo ($p_d["bname"]) ?>
                        </div>
                        <div class="col-6">
                            <strong>Model :</strong>&nbsp;<?php echo ($p_d["mname"]) ?>
                        </div>
                        <div class="col-12">
                            <textarea name="" class="form-control" readonly id="" cols="30" rows="10"><?php echo ($p_d["description"]) ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 my-2">
                    <div class="row justify-content-center">
                        <div class="card bg-success mb-3 overflow-scroll" style="height: 400px;">
                            <div class="card-header fw-bold text-light">Feedbacks</div>
                            <div class="card-body">

                                <?php
                                $feedback_rs = Database::search("SELECT * FROM `feedback` 
                            INNER JOIN user ON user.email=feedback.user_email
                            WHERE `product_id`='" . $pid . "' ");
                                $feedback_num = $feedback_rs->num_rows;
                                for ($f = 0; $f < $feedback_num; $f++) {
                                    $feedback_d = $feedback_rs->fetch_assoc();
                                ?>
                                    <div class="card text-dark mb-2">
                                        <div class="row g-0">
                                            <div class="col-4 d-flex justify-content-center align-items-center">
                                                <img src="sample/newuser.svg" class="img-fluid rounded-circle w-50" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo ($feedback_d["fname"] . " " . $feedback_d["lname"]) ?></h5>
                                                    <span class="card-text"><?php echo ($feedback_d["feedback"]) ?></span><br>
                                                    <?php
                                                    $star = (int)$feedback_d["star"];
                                                    ?>
                                                    <span>
                                                        <?php
                                                        for ($s = 0; $s < $star; $s++) {
                                                        ?>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                        <?php
                                                        }

                                                        for ($u = 0; $u < 5 - $star; $u++) {
                                                        ?>
                                                            <i class="bi bi-star"></i>
                                                        <?php
                                                        }
                                                        ?>

                                                    </span>
                                                    <p class="card-text mt-2"><small class="text-muted"><?php echo ($feedback_d["time"]) ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

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
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: index.php");
    exit;
}
?>