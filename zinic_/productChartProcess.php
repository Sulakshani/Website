<?php


$product_rs = Database::search("SELECT COUNT(*) AS num_of_product,bname,mname,CONCAT(`bname`,' ',`mname`) AS title  FROM `product`
INNER JOIN brand_has_model ON brand_has_model.id=product.brand_has_model_id
INNER JOIN brand ON brand_has_model.brand_id=brand.id
INNER JOIN model ON brand_has_model.model_id=model.id
GROUP BY `brand_has_model_id` ORDER BY num_of_product DESC LIMIT 5  ");

$total_product_rs = Database::search("SELECT COUNT(*) AS totle FROM product");
$total_product_d = $total_product_rs->fetch_assoc();

$product_num = $product_rs->num_rows;
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("l jS \of F Y h:i:s A");

$array1;
$array1["date"] = $date;
$t_prsetage = 0;
for ($x = 0; $x < $product_num; $x++) {
    $product_d = $product_rs->fetch_assoc();
    $presetage = (int)$product_d["num_of_product"] / (int)$total_product_d["totle"] * 100;
    $array1["n" . $x] = (int)$presetage;
    $array1["t" . $x] = $product_d["title"];
    $t_prsetage = $t_prsetage + $presetage;
}

$array1["other"] = 100 - (int)$t_prsetage;


?>

<script>
    window.onload = function() {

        setTimeout(incomeChart(), 1);
        setTimeout(customChart(), 1);

        var options3 = {
            animationEnabled: true,
            title: {
                text: "Products In Stock"
            },
            data: [{
                type: "pie",
                startAngle: 45,
                showInLegend: "true",
                legendText: "{label}",
                indexLabel: "{label} ({y})",
                yValueFormatString: "#,##0.#" % "",
                dataPoints: [{
                        label: "Organic",
                        y: 36
                    },
                    {
                        label: "<?php echo($array1["t0"]) ?>",
                        y: <?php echo $array1["n0"] ?>
                    },
                    {
                        label: "<?php echo($array1["t1"]) ?>",
                        y: <?php echo $array1["n1"] ?>
                    },
                    {
                        label: "<?php echo($array1["t2"]) ?>",
                        y: <?php echo $array1["n2"] ?>
                    },
                    {
                        label: "<?php echo($array1["t3"]) ?>",
                        y: <?php echo $array1["n3"]  ?>
                    },
                    {
                        label: "<?php echo($array1["t4"]) ?>",
                        y: <?php echo $array1["n4"] ?>
                    },
                    {
                        label: "Others",
                        y: <?php echo $array1["other"] ?>
                    }
                ]
            }]
        };
        $("#productPieChart").CanvasJSChart(options3);

    }
</script>
<div id="productPieChart" style="height: 370px; width: 100%;"></div>