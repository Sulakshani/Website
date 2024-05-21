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
        <title>ZINIC | purchase history</title>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 bg-light d-flex flex-column justify-content-center align-items-center" style="height: 100px;">
                    <h3 class="fw-bold">purchase history</h3>
                </div>
            </div>
        </div>

        <div class="container-fluid my-2">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">


                    <?php
                    $invoice_rs = Database::search("SELECT invoice.order_id,code1,buy_price,invoice_item.qty,title,a_status,product.id FROM `invoice`
                            INNER JOIN invoice_item ON invoice.order_id=invoice_item.invoice_order_id
                            INNER JOIN product ON product.id=invoice_item.product_id 
                            INNER JOIN img ON img.product_id=product.id 
                            WHERE user_email='" . $email . "' && `u_status`=1 ORDER BY `time` DESC ");  # u_status is vaery importebd it use to obtaine the list of purchas product which non deleted by user
                    $invoice_num = $invoice_rs->num_rows;

                    if ($invoice_num == 0) {
                    ?>
                        <div class="card w-100">
                            <div class="card-body text-center">
                                <h5 class="card-title text-danger fw-bold">No items Yet</h5>
                                <p class="card-text">No result found</p>
                                <a href="shop.php" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Purchased Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                for ($x = 0; $x < $invoice_num; $x++) {
                                    $invoice_d = $invoice_rs->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo ((int)$x + 1) ?></td>
                                        <td>
                                            <div class="d-flex flex-lg-row align-items-center">
                                                <img src="<?php echo ($invoice_d["code1"]) ?>" class="d-none d-sm-block" style="width: 100px; object-fit: contain;">
                                                &nbsp;&nbsp;<span><?php echo ($invoice_d["title"]) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo ($invoice_d["buy_price"]) ?>
                                        </td>
                                        <td>
                                            <span><?php echo ($invoice_d["qty"]) ?></span>
                                        </td>
                                        <td>
                                            <div class="d-grid">
                                                <?php
                                                if ($invoice_d["a_status"] == 0) {
                                                ?><div class="btn btn-warning">Processing</div><?php
                                                                                            } else if ($invoice_d["a_status"] == 1) {
                                                                                                ?><div class="btn btn-primary">In courier</div><?php
                                                                                                                                        } else {
                                                                                                                                            ?><div class="btn btn-success">Deliverd</div><?php
                                                                                                                                                                                        }
                                                                                                                                                                                            ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end align-items-center flex-column flex-lg-row">
                                                <a href="invoice.php?order_id=<?php echo ($invoice_d["order_id"]) ?>" class="btn btn-info"><i class="bi bi-eye text-light"></i></a>
                                                <div class="btn btn-primary m-1 feedbackModal" onclick="getFeedbackModal('<?php echo ($invoice_d['order_id']) ?>','<?php echo ($invoice_d['id']) ?>')"><i class="bi bi-chat-left-dots"></i></div>
                                                <div class="btn btn-danger" onclick="changeInvoiceUserStatus('<?php echo ($invoice_d['id']) ?>','<?php echo ($invoice_d['order_id']) ?>')"><i class="bi bi-trash"></i></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal" tabindex="-1" id="feedback_modal<?php echo ($invoice_d["order_id"] . "_" . $invoice_d["id"]) ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        <div class="row">
                                                            <div class="col-12 text-center">
                                                                Feedback
                                                            </div>
                                                        </div>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-12 text-center" id="rating_star">
                                                            <h6>Add Rating</h6>

                                                            <?php
                                                            for ($y = 1; $y < 6; $y++) {
                                                            ?>
                                                                <i class="bi bi-star" id="starRatind_<?php echo ($invoice_d['order_id'] . "_" . $invoice_d["id"] . "_" . $y) ?>" onclick="ratingMyProduct('<?php echo ($y) ?>','<?php echo ($invoice_d['order_id']) ?>','<?php echo ($invoice_d['id']) ?>');"></i>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="col-12">
                                                            <h6>Enter your feedback</h6>
                                                            <textarea name="" class="form-control" id="feedbackMsg_<?php echo ($invoice_d["order_id"] . "_" . $invoice_d["id"]) ?>" cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="saveFeedback('<?php echo ($invoice_d['id']) ?>','<?php echo ($invoice_d['order_id']) ?>');">Save Feedback</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->

                            <?php
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>

                    <!-- Latest Release -->
                    <div class="col-12 p-4 bg-light my-4 mx-2">
                <h1></h1>
                <h3 class="latest-release"> Shop our Latest Releases</h3>
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

                                <div class="card border-0 rounded mx-2" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus" data-bs-content="<?php echo ($relest_d["description"]) ?>"
                                    title="<?php echo ($relest_d["title"]) ?>" style="width: 250px;">
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-1">New</span>
                                    <img src="<?php echo ($relest_d["code1"]) ?>"
                                        class="card-img-top img-fluid img-thumbnail rounded-0"
                                        style="height: 150px; object-fit: contain;" />
                                    <div class="card-body text-center p-0">
                                        <h5 class="card-title"><?php echo ($relest_d["title"]) ?></h5>
                                        <div class="row d-grid gap-1">
                                            <?php if ($relest_d["qty"] > 0) { ?>
                                                <a href="singleProductView.php?pid=<?php echo ($relest_d["id"]) ?>"
                                                    class="btn btn-danger"><i class="bi bi-cash"></i> Buy Now</a>
                                                <a class="btn btn-success"
                                                    onclick="addToCart(<?php echo ($relest_d['id']); ?>);"><i
                                                        class="bi bi-cart"></i> Add to cart</a>
                                            <?php } else { ?>
                                                <a class="btn btn-danger disabled"><i class="bi bi-cash"></i> Buy Now</a>
                                                <a class="btn btn-success disabled"><i class="bi bi-cart"></i> Add to cart</a>
                                            <?php } ?>
                                            <?php
                                            $watchlist_num;
                                            if (isset($_SESSION["u"])) {
                                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $relest_d['id'] . "' && `user_email`='" . $email . "'");
                                                $watchlist_num = $watchlist_rs->num_rows;
                                            }
                                            ?>
                                            <a class="btn btn-light watchlist<?php echo ($relest_d['id']) ?>"
                                                onclick="addToWatchlist_2(<?php echo ($relest_d['id']) ?>)"><i
                                                    class="bi bi-heart-fill <?php if ($watchlist_num > 0) { ?>text-danger<?php } ?>"></i>
                                                Add to Watchlist</a>
                                        </div>
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
                                                <img src="<?php echo ($relest_d["code1"]) ?>"
                                                    class="card-img-top img-fluid img-thumbnail"
                                                    style="height: 150px; object-fit: contain;">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title"><?php echo ($relest_d["title"]) ?></h5>
                                                    <div class="row d-grid g-1">
                                                        <?php
                                                        if ($relest_d["qty"] > 0) {
                                                            ?>
                                                            <a href="singleProductView.php?pid=<?php echo ($relest_d["id"]) ?>"
                                                                class="btn btn-danger"><i class="bi bi-cash"></i> Buy Now</a>
                                                            <a class="btn btn-success"
                                                                onclick="addToCart(<?php echo ($relest_d['id']); ?>);"><i
                                                                    class="bi bi-cart"></i> Add to cart</a>
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
                                                        <a class="btn btn-light watchlist<?php echo ($relest_d['id']) ?>"><i
                                                                class="bi bi-heart-fill <?php if ($watchlist_num > 0) {
                                                                    ?>text-danger<?php
                                                                } ?>"
                                                                onclick="addToWatchlist(<?php echo ($relest_d['id']) ?>)"></i>
                                                            Add to Watchlist</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }

                                    ?>

                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon btn btn-secondary"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon btn btn-secondary"
                                        aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php include "footer.php"; ?>
    </body>

    
    <script src="jQuery 3.6.1.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>

    </html>
<?php
} else {
    header("Location: index.php");
    exit;
}
?>