<?php
require "connection.php";
$price = $_POST["price"];
$cat = $_POST["cat"];
$brand = $_POST["brand"];
$q = "SELECT * FROM `brand` 
INNER JOIN `brand_has_model` ON brand.id=brand_has_model.brand_id
INNER JOIN `model` ON brand_has_model.model_id=model.id
INNER JOIN `product` ON product.brand_has_model_id=brand_has_model.id
INNER JOIN `img` ON img.product_id=product.id ";
if ($cat != null and $brand != null and $price == "1") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " and ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
} else if ($cat != null and $brand != null and $price == "2") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " and ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price < 150000";
} else if ($cat != null and $brand != null and $price == "3") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " and ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price BETWEEN 150000 and 350000";
} else if ($cat != null and $brand != null and $price == "4") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " and ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price > 350000";
}


// non cat

if ($cat == null and $brand != null and $price == "1") {
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " WHERE ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
} else if ($cat == null and $brand != null and $price == "2") {
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " WHERE ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price < 150000";
} else if ($cat == null and $brand != null and $price == "3") {
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " WHERE ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price BETWEEN 150000 and 350000";
} else if ($cat == null and $brand != null and $price == "4") {
    $b = explode(",", $brand);
    $len2 = sizeof($b);
    $q = $q . " WHERE ( brand_id=$b[0]";
    for ($i = 1; $i < $len2; $i++) {
        $q = $q . " or brand_id=$b[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price > 350000";
}

//non brand

if ($cat != null and $brand == null and $price == "1") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
} else if ($cat != null and $brand == null and $price == "2") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price < 150000";
} else if ($cat != null and $brand == null and $price == "3") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price BETWEEN 150000 and 350000";
} else if ($cat != null and $brand == null and $price == "4") {
    $c = explode(",", $cat);
    $len1 = sizeof($c);
    $q = $q . " WHERE ( category_id=$c[0]";
    for ($i = 1; $i < $len1; $i++) {
        $q = $q . " or category_id=$c[$i]";
    }
    $q = $q . " )";
    $q = $q . " and price > 350000";
}

//both null

if ($cat == null and $brand == null and $price == "1") {
} else if ($cat == null and $brand == null and $price == "2") {
    $q = $q . " WHERE price < 150000";
} else if ($cat == null and $brand == null and $price == "3") {
    $q = $q . " WHERE price BETWEEN 150000 and 350000";
} else if ($cat == null and $brand == null and $price == "4") {
    $q = $q . " WHERE price > 350000";
}













$rs = Database::search($q);
$num_rows = $rs->num_rows;
if ($num_rows > 0) {
    while ($d = $rs->fetch_assoc()) {
?>

        <div class="col-md-4">
            <div class="model-card">
                <img src="<?php echo $d["code1"]; ?>" class="img-fluid mx-auto d-block" alt="">
                <h4 class="text-center"><?php echo $d["mname"]; ?></h4>
                <div class="text-center">
                    <a href="singleProductView.php?pid=<?php echo $d['id']; ?>" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>

<?php
    }
}else{
    echo "<h2>Not Found</h2>";
}
?>