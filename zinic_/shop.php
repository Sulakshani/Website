<?php
require "connection.php";
session_start();
$x=2;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZINIC | Shop</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="./logoH.jpeg">
    <style>
        /* Additional custom styles */
        body {
            background-color: #f8f9fa;
            margin: 0px;
            padding: 0px;
        }

        .category-section {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .brand-section {
            background-color: #f0f0f0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .model-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .model-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .model-card img {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
        }

        .model-card h4 {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <?php include "header.php"; ?>

    <div class="container-fluid p-5">

        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="row gap-3">
                    <div class="">
                        <span class="fw-bold">Search Product</span>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="searchBarLarge_1" placeholder="Search">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="searchProduct()"><i class="bi bi-search"></i></button>
                        </div>
                        <span class="fw-bold">Price</span>
                        <hr class="border border-2 border-dark my-1">
                        <input type="radio" name="price" id="sort_price_1">&nbsp;<label for="sort_price_1">All</label> <br>
                        <input type="radio" name="price" id="sort_price_2">&nbsp;<label for="sort_price_2">Below 150000</label> <br>
                        <input type="radio" name="price" id="sort_price_3">&nbsp;<label for="sort_price_3">Between 150K & 350K</label> <br>
                        <input type="radio" name="price" id="sort_price_4">&nbsp;<label for="sort_price_4">Above 350K</label>
                    </div>
                    <div class="">
                        <span class="fw-bold">Catagory</span>
                        <hr class="border border-2 border-dark my-1">
                        <?php
                        $sub_rs = Database::search("SELECT * FROM `category`");
                        $sub_num = $sub_rs->num_rows;
                        while ($sub_d = $sub_rs->fetch_assoc()) {
                        ?>
                            <input type="checkbox" name="cat" id="sort_cat_<?php echo $sub_d["id"] ?>" value="<?php echo $sub_d["id"] ?>">&nbsp;<label for="sort_cat_<?php echo $sub_d["id"] ?>"><?php echo $sub_d["catname"] ?></label> <br>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="">
                        <span class="fw-bold">Brand</span>
                        <hr class="border border-2 border-dark my-1">
                        <?php
                        $b_rs = Database::search("SELECT * FROM `brand`");
                        $b_num = $b_rs->num_rows;
                        while ($b_d = $b_rs->fetch_assoc()) {
                        ?>
                            <input type="checkbox" name="cat" id="sort_b_<?php echo $b_d["id"] ?>">&nbsp;<label for="sort_b_<?php echo $b_d["id"] ?>"><?php echo $b_d["bname"] ?></label> <br>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 d-grid">
                        <div class="btn btn-primary" onclick="sortProduct(<?php echo ($sub_num) ?>,<?php echo ($b_num) ?>)">Sort</div>
                    </div>
                    <div class="col-6 d-grid">
                        <div class="btn btn-secondary" onclick="clearSortAll()">Clear</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="row justify-content-center">
                    <div class="">
                        <div class="model-section">
                            <h3 class="text-center mb-4">Featured Models</h3>
                            <div class="row" id="sort_search_items">
                                <?php
                                $products_rs = Database::search("SELECT * FROM `brand` 
                                INNER JOIN `brand_has_model` ON brand.id=brand_has_model.brand_id
                                INNER JOIN `model` ON brand_has_model.model_id=model.id
                                INNER JOIN `product` ON product.brand_has_model_id=brand_has_model.id
                                INNER JOIN `img` ON img.product_id=product.id ");
                                while ($products_d = $products_rs->fetch_assoc()) {
                                ?>

                                    <div class="col-md-4">
                                        <div class="model-card">
                                            <img src="<?php echo $products_d["code1"]; ?>" class="img-fluid mx-auto d-block" alt="">
                                            <h4 class="text-center"><?php echo $products_d["mname"]; ?></h4>
                                            <div class="text-center">
                                                <a href="singleProductView.php?pid=<?php echo $products_d['id']; ?>" class="btn btn-primary">View Details</a>
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