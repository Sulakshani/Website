<?php

session_start();
require "connection.php";
$email;
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
}
$x=1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="color: #E89105;">ZINIC | Home</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="./logoH.jpeg">

    <style>
        .btn {
            border: 2px solid grey;
            border-radius: 50%;
            display: inline-block;

        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container-fluid mt-5">

        <div class="row justify-content-center">
            <!-- carousel -->
            <div class="carousel">
                <!-- list item -->
                <div class="list">
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/home/04262024-2/HP_KV5_S24-ultra_Lifestyle_1_pc.jpg?imwidth=1536">
                        <div class="content">
                            <div class="author">Apple</div>
                            <div class="title">New Release</div>
                            <div class="topic">Meet your new galaxy</div>
                            <div class="des">
                                <!-- lorem 50 -->
                                Bundle and save upto instant trade in credit <br />
                                with Galaxy 24 ultra Lifestyle 1 pc latest.
                            </div>
                            <div class="buttons">
                                <button class="btn bg-dark rounded-3" style="color: white;">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/galaxybooks/04192024/GBPCD-HD01-HomeKV-GB4Pro-D.jpg?imwidth=1366">
                        <div class="content">
                            <div class="author">Apple</div>
                            <div class="title">New Release</div>
                            <div class="topic">Meet your new galaxy</div>
                            <div class="des">
                                <!-- lorem 50 -->
                                Bundle and save upto instant trade in credit <br />
                                with Galaxy 24 ultra Lifestyle 1 pc latest.
                            </div>
                            <div class="buttons">
                                <button class="btn bg-dark rounded-3" style="color: white;">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/galaxybooks/04192024/GBPCD-HD01-HomeKV-GB4Pro360-D.jpg?imwidth=2560">
                        <div class="content">
                            <div class="author">Apple</div>
                            <div class="title">New Release</div>
                            <div class="topic">Meet your new galaxy</div>
                            <div class="des">
                                <!-- lorem 50 -->
                                Bundle and save upto instant trade in credit <br />
                                with Galaxy 24 ultra Lifestyle 1 pc latest.
                            </div>
                            <div class="buttons">
                                <button class="btn bg-dark rounded-3" style="color: white;">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/home/04262024/LDY-HP-DT.jpg?imwidth=1536">
                        <div class="content">
                            <div class="author">Apple</div>
                            <div class="title">New Release</div>
                            <div class="topic">Meet your new galaxy</div>
                            <div class="des">
                                <!-- lorem 50 -->
                                Bundle and save upto instant trade in credit <br />
                                with Galaxy 24 ultra Lifestyle 1 pc latest.
                            </div>
                            <div class="buttons">
                                <button class="btn bg-dark rounded-3" style="color: white;">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- list thumnail -->
                <div class="thumbnail">
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/home/04262024-2/HP_KV5_S24-ultra_Lifestyle_1_pc.jpg?imwidth=1536">
                        <div class="content">
                            <div class="title">
                                Galaxy S 24
                            </div>
                            <div class="description">
                                Connect everywhere
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/galaxybooks/04192024/GBPCD-HD01-HomeKV-GB4Pro-D.jpg?imwidth=1366">
                        <div class="content">
                            <div class="title">
                                Macbook pro M3
                            </div>
                            <div class="description">
                                World with you
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/galaxybooks/04192024/GBPCD-HD01-HomeKV-GB4Pro360-D.jpg?imwidth=2560">
                        <div class="content">
                            <div class="title">
                                SE ultra
                            </div>
                            <div class="description">
                                Flexible as you
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="https://images.samsung.com/is/image/samsung/assets/us/home/04262024/LDY-HP-DT.jpg?imwidth=1536">
                        <div class="content">
                            <div class="title">
                                Multi Purpose
                            </div>
                            <div class="description">
                                Do everything
                            </div>
                        </div>
                    </div>
                </div>
                <!-- next prev -->

                <div class="arrows">
                    <button id="prev">
                        < </button>
                            <button id="next">></button>
                </div>
                <!-- time running -->
                <div class="time"></div>
            </div>

            <!-- Latest Release -->
            <div class="col-12 py-5 bg-light mt-5 mb-5 mx-2 text-center">
                <h3 class="latest-release mb-2">Newly Arrivals!</h3>
                <div class="row">

                    <div class="col-12 d-none d-md-block">
                        <div class="row gap-1 justify-content-center">

                            <?php

                            $relest_rs = Database::search("SELECT * FROM `product` 
                            INNER JOIN `img` ON product.id=img.product_id
                            WHERE `status_id`='1' ORDER BY `upload_date` DESC LIMIT 5 ");
                            $relest_num = $relest_rs->num_rows;

                            for ($x = 0; $x < $relest_num; $x++) {
                                $relest_d = $relest_rs->fetch_assoc();
                            ?>

                                <div class="card border-0 rounded mx-2" id="" onmouseover="showAddCard(<?php echo $relest_d['id'] ?>)" 
                                onmouseout="hideAddCard(<?php echo $relest_d['id'] ?>)" tabindex="0" data-bs-toggle="popover" 
                                data-bs-trigger="hover focus" data-bs-content="<?php echo ($relest_d["description"]) ?>" 
                                title="<?php echo ($relest_d["title"]) ?>" style="width: 250px;">

                                    <span class="badge bg-danger position-absolute top-2 end-0 m-1">New</span>
                                    <div class="row">
                                        <div class="col-12" id="main_img_<?php echo $relest_d["id"] ?>">
                                            <img src="<?php echo ($relest_d["code1"]) ?>" class="card-img-top border-0 img-fluid img-thumbnail rounded-2" style="width: 100%; object-fit: contain;" />
                                        </div>
                                        <div class="d-none" id="addCard_<?php echo $relest_d["id"] ?>">
                                            <div class="addCard d-flex flex-column gap-1" id="referenceCard_<?php echo $relest_d["id"] ?>">
                                                <?php if ($relest_d["qty"] > 0) { ?>
                                                    <a href="singleProductView.php?pid=<?php echo ($relest_d["id"]) ?>" class="btn"><i class="bi bi-cash"></i></a>
                                                    <a class="btn" onclick="addToCart(<?php echo ($relest_d['id']); ?>);"><i class="bi bi-cart"></i></a>
                                                <?php } else { ?>
                                                    <a class="btn disabled"><i class="bi bi-cash"></i></a>
                                                    <a class="btn disabled"><i class="bi bi-cart"></i></a>
                                                <?php } ?>
                                                <?php
                                                $watchlist_num;
                                                if (isset($_SESSION["u"])) {
                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $relest_d['id'] . "' && `user_email`='" . $email . "'");
                                                    $watchlist_num = $watchlist_rs->num_rows;
                                                }
                                                ?>
                                                <a class="btn watchlist<?php echo ($relest_d['id']) ?>" onclick="addToWatchlist(<?php echo ($relest_d['id']) ?>)"><i class="bi bi-heart-fill <?php if ($watchlist_num > 0) { ?>text-danger<?php } ?>"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body text-center p-0">
                                        <h5 class="card-title"><?php echo ($relest_d["title"]) ?></h5>
                                        <h6 style="color: red;">Rs.<?php echo ($relest_d["price"]) ?> /=</h6>


                                    </div>
                                </div>

                            <?php
                            }

                            ?>

                        </div>
                    </div>

                    <div class="col-12 d-block d-md-none">
                        <div class="row">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">

                                    <?php

                                    $relest_rs = Database::search("SELECT * FROM `product` 
                                    INNER JOIN `img` ON product.id=img.product_id 
                                    WHERE `status_id`='1' ORDER BY `upload_date` DESC LIMIT 5 ");
                                    $relest_num = $relest_rs->num_rows;

                                    for ($x = 0; $x < $relest_num; $x++) {
                                        $relest_d = $relest_rs->fetch_assoc();
                                    ?>

                                        <div class="carousel-item <?php
                                                                    if ($x == 0) {
                                                                    ?>active<?php
                                                                        }
                                                                            ?>">
                                            <div class="card mx-auto" style="max-width: 250px;">
                                                <span class="badge bg-info position-absolute m-1">New</span>
                                                <img src="<?php echo ($relest_d["code1"]) ?>" class="card-img-top img-fluid img-thumbnail" style="height: 150px; object-fit: contain;">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title"><?php echo ($relest_d["title"]) ?></h5>
                                                    <h6><?php echo ($relest_d["price"]) ?></h6>
                                                    <div class="row d-grid g-1">
                                                        <?php
                                                        if ($relest_d["qty"] > 0) {
                                                        ?>
                                                            <a href="singleProductView.php?pid=<?php echo ($relest_d["id"]) ?>" class="btn btn-danger"><i class="bi bi-cash"></i> Buy Now</a>
                                                            <a class="btn btn-success" onclick="addToCart(<?php echo ($relest_d['id']); ?>);"><i class="bi bi-cart"></i> Add to cart</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a class="btn btn-danger disabled"><i class="bi bi-cash"></i> Buy
                                                                Now</a>
                                                            <a class="btn btn-success disabled"><i class="bi bi-cart"></i> Add
                                                                to cart</a>
                                                        <?php
                                                        }
                                                        $watchlist_num;
                                                        if (isset($_SESSION["u"])) {
                                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $relest_d['id'] . "' && `user_email`='" . $email . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;
                                                        }
                                                        ?>
                                                        <a class="btn btn-light watchlist<?php echo ($relest_d['id']) ?>"><i class="bi bi-heart-fill <?php if ($watchlist_num > 0) {
                                                                                                                                                        ?>text-danger<?php
                                                                                                                                                                    } ?>" onclick="addToWatchlist(<?php echo ($relest_d['id']) ?>)"></i>
                                                            Add to Watchlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon btn btn-secondary" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon btn btn-secondary" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Add -->

            <img class="my-2" src="./3.png" alt="add">

            <!-- Categories -->
            <div class="mt-4 py-5 px-5 bg-light">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php
                    // Fetch categories from the database
                    $cat_rs = Database::search("SELECT * FROM `category`");

                    // Check if the query was successful and the result is not null
                    if ($cat_rs !== false && $cat_rs->num_rows > 0) {
                        // Loop through categories to create tabs
                        while ($cat_d = $cat_rs->fetch_assoc()) {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link  <?php if ($cat_d['id'] == 1)
                                                        echo 'active'; ?>" id="category-<?php echo $cat_d['id']; ?>-tab" data-bs-toggle="tab" href="#category-<?php echo $cat_d['id']; ?>" role="tab" aria-controls="category-<?php echo $cat_d['id']; ?>" aria-selected="<?php echo ($cat_d['id'] == 1) ? 'false' : 'true'; ?>" style="color:black; font-size:16px;"><?php echo $cat_d['catname']; ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- Tab panes -->
            <div class="tab-content pt-2 pb-5 px-5 bg-light" id="myTabContent">
                <?php
                // Reset result set pointer
                if ($cat_rs !== false) {
                    $cat_rs->data_seek(0);
                }

                // Loop through categories to create tab panes
                while ($cat_d = $cat_rs->fetch_assoc()) {
                ?>
                    <div class="tab-pane fade <?php if ($cat_d['id'] == 1)
                                                    echo 'show active'; ?>" id="category-<?php echo $cat_d['id']; ?>" role="tabpanel" aria-labelledby="category-<?php echo $cat_d['id']; ?>-tab">
                        <!-- Content for <?php echo $cat_d['catname']; ?> category -->
                        <div class="row justify-content-center">
                            <?php
                            // Fetch products for this category
                            $product_rs = Database::search("SELECT code1,title,`description`,qty,product.id FROM `product` 
                INNER JOIN `brand_has_model` ON product.brand_has_model_id=brand_has_model.id 
                INNER JOIN `brand` ON brand_has_model.brand_id=brand.id INNER JOIN `img` ON product.id=img.product_id
                WHERE product.category_id='" . $cat_d["id"] . "' && status_id=1 GROUP BY `bname` ");
                            while ($product_d = $product_rs->fetch_assoc()) {
                                // Display each product as a card
                                //include 'product_card.php'; // Include the file containing the card markup
                            ?>
                                <div class="col-md-4 col-10 mb-4">
                                    <div class="card h-100 shadow">
                                        <div class="position-relative mx-5">
                                            <img src="<?php echo ($product_d["code1"]); ?>" alt="<?php echo $product_d["title"]; ?>" style="width: 90%; object-fit: fill;">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product_d["title"]; ?></h5>
                                            <p class="card-text"><?php echo $product_d["description"]; ?></p>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <?php if ($product_d["qty"] > 0) { ?>
                                                        <button class="btn btn-danger rounded-2" onclick="addToCart(<?php echo $product_d['id']; ?>);"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-danger disabled rounded-2"><i class="bi bi-cart-plus"></i> Out
                                                            of Stock</button>
                                                    <?php } ?>
                                                </div>
                                                <div>
                                                    <button class="btn btn-outline-secondary rounded-2" onclick="addToWatchlist(<?php echo $product_d['id']; ?>);"><i class="bi bi-heart"></i> Add to Wishlist</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- 
           
            <section class="feedback-section bg-light py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Send Us Your Feedback</h2>
                            <p>We value your feedback! Let us know what you think about our products or services.</p>
                        </div>
                        <div class="col-md-6">
                            <form action="#" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Your Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" rows="3" placeholder="Your Message"
                                        required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- What is ZINIC -->
            <div class="container mt-3 m-4 ">
                <div class="row">
                    <div class="text-center my-4">
                        <h1><em style="color:white;">We are ZINIC</em></h1>

                    </div>
                </div>
                <div class="row pb-5 my-2">
                    <div class="col-md-4">
                        <div class="card border-0 rounded-3 shadow bg-warning" style="backdrop-filter: blur(100px); font-family:'Times New Roman', Times, serif">
                            <div class="card-body text-center">
                                <h3 class="fw-bold mb-4" style="color:white;">What is ZINIC?</h3>
                                <p class="fs-5" style="color:white;">ZINIC is your ultimate destination for all your
                                    electronic device needs.
                                    We provide a global online marketplace where you can explore, purchase, and sell a
                                    diverse range of unique electronic products.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 rounded-3 shadow bg-warning">
                            <div class="card-body text-center">
                                <h3 class="fw-bold mb-4" style="color:white;">Discover Unique Products</h3>
                                <p class="fs-5" style="color:white;">At ZINIC, we empower independent creators and
                                    sellers. Dive into our
                                    curated collection of electronic devices, gadgets, and accessories crafted with
                                    passion from artisans across the globe.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 rounded-3 shadow bg-warning">
                            <div class="card-body text-center">
                                <h3 class="fw-bold mb-4" style="color:white;">Our Commitment</h3>
                                <p class="fs-5" style="color:white;">ZINIC is dedicated to ensuring your peace of mind.
                                    Your privacy and
                                    security are our top priorities, and our dedicated team is available round-the-clock
                                    to provide you with unparalleled support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscribe -->
            <section class="subscribe-section bg-secondary py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 style="color: white;">Subscribe to Our Newsletter</h2>
                            <p style="color: white;">Stay up-to-date with our latest products and offers by subscribing to our newsletter.</p>
                        </div>
                        <div class="col-md-6">
                            <form action="#" method="post">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="subscribe-btn">
                                    <button class="btn btn-info rounded-3" type="button" id="subscribe-btn">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>



        </div>
    </div>

    <?php include "footer.php"; ?>


    <script src="jQuery 3.6.1.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="app.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>