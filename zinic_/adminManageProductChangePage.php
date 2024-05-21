<div class="col-12">
    <div class="row" id="adminProductView">
        <?php
        require "connection.php";
        session_start();

        if(isset($_SESSION["au"])){
           

        $page;
        if (isset($_GET["page"])) {
            $page = (int)$_GET["page"];
        } else {
            $page = 1;
        }
        $product_per_page = 4; #product per page any value I give 6
        $pro_rs = Database::search("SELECT * FROM `product`");
        $pro_num = $pro_rs->num_rows;

        $num_of_page = ceil($pro_num / $product_per_page);

        $offset = $product_per_page * ($page - 1);

        $product_rs = Database::search("SELECT product.id,colour,code1,qty,price,title,status_id FROM `product` 
                    LEFT OUTER JOIN `img` ON product.id=img.product_id
                    INNER JOIN `colour` ON product.colour_id=colour.id
                    ORDER BY `upload_date` DESC  LIMIT " . $product_per_page . " OFFSET " . $offset . " ");
        $product_num = $product_rs->num_rows;
        for ($x = 0; $x < $product_num; $x++) {
            $product_d = $product_rs->fetch_assoc();
        ?>

            <div class="card mb-3 col-12 col-lg-6">
                <div class="row g-0">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <img src="<?php echo ($product_d["code1"]) ?>" class="img-fluid rounded-start" style="width: 150px; height: 150px; object-fit: contain;">
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($product_d["title"]) ?></h5>
                            <span class="card-text"><strong>Price :</strong>&nbsp;Rs. <?php echo ($product_d["price"]) ?> .00</span><br>
                            <span class="card-text"><strong>In stock :</strong><small>&nbsp;<?php echo ($product_d["qty"]) ?> items avilable</small></span><br>
                            <span class="card-text"><strong>Colour :</strong>&nbsp;<?php echo ($product_d["colour"]) ?></span>

                            <?php

                            if ($product_d["status_id"] == 1) {
                            ?>
                                <div class="form-check form-switch d-flex justify-content-center gap-2">
                                    <input class="form-check-input" type="checkbox" checked role="switch" id="productActivation<?php echo ($product_d["id"]) ?>" onclick="statusChange(<?php echo ($product_d['id']) ?>);">
                                    <label class="form-check-label" for="productActivation<?php echo ($product_d["id"]) ?>">Make Deactive</label>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="form-check form-switch d-flex justify-content-center gap-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onclick="statusChange(<?php echo ($product_d['id']) ?>);">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Make Active</label>
                                </div>
                            <?php
                            }

                            ?>

                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center justify-content-center flex-column">
                        <div class="row g-2">
                            <div class="col-12 d-grid">
                                <a href="adminUpdateProduct.php?pid=<?php echo ($product_d["id"]) ?>" class="btn btn-success">Update</a>
                            </div>
                            <div class="col-12 d-grid">
                                <div class="btn btn-danger" onclick="deleteProduct(<?php echo ($product_d['id']); ?>);">Delete</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }

        ?>

        <nav aria-label="Page navigation example" class="">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($page > 1) {
                                                $previous = $page - 1; ?> onclick="manageProductChangePage('<?php echo ($previous) ?>')" <?php
                                                                                                                                        } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for ($y = 1; $y <= $num_of_page; $y++) {
                ?>
                    <li class="page-item <?php if ($page == $y) {
                                            ?>active<?php
                                                } ?>"><a class="page-link" onclick="manageProductChangePage('<?php echo ($y); ?>')"><?php echo ($y); ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($page < $num_of_page) {
                                                $next = $page + 1; ?>onclick="manageProductChangePage('<?php echo ($next) ?>')" <?php
                                                                                                                            } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<?php
}
?>