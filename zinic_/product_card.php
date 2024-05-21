<div class="col-md-4 mb-4">
    <div class="card h-100 shadow">
        <div class="position-relative">
        <img src="<?php echo ($product_d["./code1"]); ?>"alt="<?php echo $product_d["title"]; ?>"
                                        style="width: 100px; height: 100px; object-fit: contain;">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $product_d["title"]; ?></h5>
            <p class="card-text"><?php echo $product_d["description"]; ?></p>
        </div>
        <div class="card-footer bg-transparent border-top-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <?php if ($product_d["qty"] > 0) { ?>
                        <button class="btn btn-danger" onclick="addToCart(<?php echo $product_d['id']; ?>);"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                    <?php } else { ?>
                        <button class="btn btn-danger disabled"><i class="bi bi-cart-plus"></i> Out of Stock</button>
                    <?php } ?>
                </div>
                <div>
                    <button class="btn btn-outline-secondary" onclick="addToWatchlist(<?php echo $product_d['id']; ?>);"><i class="bi bi-heart"></i> Add to Wishlist</button>
                </div>
            </div>
        </div>
    </div>
</div>
