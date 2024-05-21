<?php

require "connection.php";
session_start();

$txt = $_POST["txt"];

$search_rs = Database::search("SELECT * FROM `brand` 
INNER JOIN `brand_has_model` ON brand.id=brand_has_model.brand_id
INNER JOIN `model` ON brand_has_model.model_id=model.id
INNER JOIN `product` ON product.brand_has_model_id=brand_has_model.id
INNER JOIN `img` ON img.product_id=product.id 
WHERE title LIKE '%" . $txt . "%' && status_id=1 && qty>0 ");

$search_num = $search_rs->num_rows;
if ($search_num > 0) {
    for ($x = 0; $x < $search_num; $x++) {
        $search_d = $search_rs->fetch_assoc();
?>

        <div class="col-md-4">
            <div class="model-card">
                <img src="<?php echo $search_d["code1"]; ?>" class="img-fluid mx-auto d-block" alt="">
                <h4 class="text-center"><?php echo $search_d["mname"]; ?></h4>
                <div class="text-center">
                    <a href="singleProductView.php?pid=<?php echo $search_d['id']; ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>

<?php
    }
} else {
    echo "<h2>Not Found</h2>";
}


?>