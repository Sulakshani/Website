<?php

require "connection.php";
session_start();
if (isset($_SESSION["au"])) {

    if (isset($_GET["pid"])) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ZINIC | Admin Dashboard</title>
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

            <div class="container-fluid">
                <div class="row p-0">

                    <div class="col-12">
                        <div class="row my-3 g-2">
                            <div class="col-12 text-center">
                                <h2 class="text-primary fw-bold h2">Update Product</h2>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <?php
                                    $pid = $_GET["pid"];

                                    $p_rs = Database::search("SELECT * FROM `product` 
                                LEFT OUTER JOIN `img` ON product.id=img.product_id
                                INNER JOIN `brand_has_model` ON product.brand_has_model_id=brand_has_model.id
                                WHERE product.id='" . $pid . "'");

                                    $p_d = $p_rs->fetch_assoc();

                                    ?>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                            </div>
                                            <div class="col-12">
                                                <select name="" class="form-select text-center" id="category" disabled>
                                                    <option value="0">Select category</option>

                                                    <?php
                                                    $cat_rs = Database::search("SELECT * FROM `category`");
                                                    $cat_num = $cat_rs->num_rows;
                                                    for ($x = 0; $x < $cat_num; $x++) {
                                                        $cat_d = $cat_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($cat_d["id"]) ?>" <?php if ($cat_d["id"] == $p_d["category_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                } ?>><?php echo ($cat_d["catname"]) ?></option>
                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                            </div>
                                            <div class="col-12">
                                                <select name="" class="form-select text-center" id="brand" disabled>
                                                    <option value="0">Select Brand</option>
                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `brand`");
                                                    $brand_num = $brand_rs->num_rows;
                                                    for ($x = 0; $x < $brand_num; $x++) {
                                                        $brand_d = $brand_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($brand_d["id"]) ?>" <?php
                                                                                                        if ($brand_d["id"] == $p_d["brand_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($brand_d["bname"]) ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                            </div>
                                            <div class="col-12">
                                                <select name="" class="form-select text-center" id="model" disabled>
                                                    <option value="0">Select Model</option>

                                                    <?php

                                                    $model_rs = Database::search("SELECT * FROM `model`");
                                                    $model_num = $model_rs->num_rows;
                                                    for ($x = 0; $x < $model_num; $x++) {
                                                        $model_d = $model_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($model_d["id"]) ?>" <?php
                                                                                                        if ($model_d["id"] == $p_d["model_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($model_d["mname"]) ?></option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <hr class="bg-success" style="height: 3px;" />
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="fw-bold form-label" style="font-size: 20px;">Add a title to your product</label>
                                    </div>
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                        <input type="text" class="form-control" id="title_update" value="<?php echo ($p_d["title"]) ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="bg-success" style="height: 3px;" />
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class=" form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check form-check-inline mx-5">
                                                    <input class="form-check-input" type="radio" id="b" value="option1" name="con" <?php
                                                                                                                                    if ($p_d["condition_id"] == 1) {
                                                                                                                                    ?>checked<?php
                                                                                                                                            }
                                                                                                                                                ?> disabled>
                                                    <label class="form-check-label fw-bold" for="b">Brand New</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="u" value="option2" name="con" <?php
                                                                                                                                    if ($p_d["condition_id"] == 2) {
                                                                                                                                    ?>checked<?php
                                                                                                                                            }
                                                                                                                                                ?> disabled>
                                                    <label class="form-check-label fw-bold" for="u">Used</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4 border-end border-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class=" form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                            </div>
                                            <div class="col-12">

                                                <select name="" class="form-select" id="clr" disabled>
                                                    <option value="0">Select Colour</option>
                                                    <?php

                                                    $colour_rs = Database::search("SELECT * FROM `colour`");
                                                    $colour_num = $colour_rs->num_rows;
                                                    for ($x = 0; $x < $colour_num; $x++) {
                                                        $colour_d = $colour_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo ($colour_d["id"]) ?>" <?php
                                                                                                        if ($colour_d["id"] == $p_d["colour_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                                    ?>><?php echo ($colour_d["colour"]) ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="" class=" form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="number" class="form-control" value="<?php echo ($p_d["qty"]) ?>" min="0" id="qty_update">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="bg-success" style="height: 3px;" />
                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-6 border-end border-success">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="fw-bold form-label" style="font-size: 20px;">Cost Per Item</label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <div class="input-group my-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" id="cost_update" value="<?php echo ($p_d["price"]) ?>">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Appruved Payment Methods</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row mx-1 mx-lg-0">
                                                    <div class="offset-0 offset-lg-2 col-3 col-lg-2">
                                                        <img src="resource/payment_method/visa_img.png" alt="" style="width: 50px;height: 50px; object-fit: contain;">
                                                    </div>
                                                    <div class="col-3 col-lg-2 pm pm2">
                                                        <img src="resource/payment_method/paypal_img.png" style="width: 50px;height: 50px; object-fit: contain;">
                                                    </div>
                                                    <div class="col-3 col-lg-2 pm pm3">
                                                        <img src="resource/payment_method/mastercard_img.png" style="width: 50px;height: 50px; object-fit: contain;">
                                                    </div>
                                                    <div class="col-3 col-lg-2 pm pm4">
                                                        <img src="resource/payment_method/american_express_img.png" style="width: 50px;height: 50px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="bg-success" style="height: 3px;" />
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea cols="30" rows="15" class="form-control" id="des_update"><?php echo ($p_d["description"]) ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="bg-success" style="height: 3px;" />
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-bold" style="font-size: 20px;">Add Product Image</label>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6">
                                        <div class="row">


                                            <?php

                                            for ($x = 0; $x < 3; $x++) {
                                            ?>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="<?php if (isset($p_d["code" . ((int)$x + 1)])) {
                                                                    echo ($p_d["code" . ((int)$x + 1)]);
                                                                } else {
                                                                ?>
                                                        resource/addproductimg.svg
                                                        <?php
                                                                } ?>" class="img-fluid" id="updateImg<?php echo ($x); ?>" style="width: 250px;">
                                                </div>
                                            <?php
                                            }

                                            ?>




                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" class="d-none" id="UpdateProductImage" multiple onchange="UpdateProductchangeImg()" />
                                        <label for="UpdateProductImage" class="col-12 btn btn-primary">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="bg-success" style="height: 3px;" />
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid my-3">
                                <button class="btn btn-success" onclick="updateProduct(<?php echo ($pid) ?>);">Save Product</button>
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
        header("Location: adminDashboard.php");
        exit;
    }
}
?>