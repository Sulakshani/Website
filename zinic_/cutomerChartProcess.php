<?php

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("l jS \of F Y h:i:s A");

$customer_rs = Database::search("SELECT COUNT(*) AS cus_per_dis,district FROM `user` 
INNER JOIN `shipping` ON user.shipping_id=shipping.id
GROUP BY `district` ORDER BY `cus_per_dis` DESC LIMIT 5 ");

$total_cus_rs = Database::search("SELECT COUNT(*) AS totle FROM user");
$total_cus_d = $total_cus_rs->fetch_assoc();

$array;

$array["date"] = $date;

$customer_num = $customer_rs->num_rows;
$array["num"] = $customer_num;
$presetage = 0;
for ($x = 0; $x < $customer_num; $x++) {
	$customer_d = $customer_rs->fetch_assoc();
	$array["c" . $x] = (int)$customer_d["cus_per_dis"] / (int)$total_cus_d["totle"] * 100;
	$presetage = $presetage + (int)$customer_d["cus_per_dis"] / (int)$total_cus_d["totle"] * 100;
	$array["d" . $x] = $customer_d["district"];
}

$array["other"] = 100 - (int)$presetage;
?>

<script>
	function customChart() {


		var options2 = {
			animationEnabled: true,
			title: {
				text: "User Expedition"
			},
			data: [{
				type: "pie",
				startAngle: 45,
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} ({y})",
				yValueFormatString: "#,##0.#" % "",
				dataPoints: [{
						label: "<?php echo ($array["d0"]) ?>",
						y: <?php echo $array["c0"] ?>
					},
					{
						label: "<?php echo ($array["d1"]) ?>",
						y: <?php echo $array["c1"] ?>
					},
					{
						label: "<?php echo ($array["d2"]) ?>",
						y: <?php echo $array["c2"] ?>
					},
					{
						label: "<?php echo ($array["d3"]) ?>",
						y: <?php echo $array["c3"] ?>
					},
					{
						label: "<?php echo ($array["d4"]) ?>",
						y: <?php echo $array["c4"] ?>
					},
					{
						label: "others",
						y: <?php echo $array["other"] ?>
					},
				]
			}]
		};
		$("#customerPieChart").CanvasJSChart(options2);

	}
</script>
<div class="" id="customerPieChart" style="width: 100%; height: 375px;"></div>