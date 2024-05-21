<?php

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");

$separate = explode("-", $date);
$year = $separate[0];
$month = $separate[1];



?>

<script>
function incomeChart() {
        //Better to construct options first and then pass it as a parameter
        var options1 = {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2",
            title: {
                text: "<?php echo ($year); ?> Monthly Income"
            },
            axisX: {
                valueFormatString: "DD MMM",
                title: "Month",
            },
            axisY: {
                title: "Income",
            },
            data: [{
                type: "spline", //change it to line, area, column, pie, etc
                xValueFormatString: "DD MMM, YYYY",
                dataPoints: [
                    <?php

                    $income = Database::search("SELECT * FROM invoice_item 
                        INNER JOIN invoice ON invoice.order_id=invoice_item.invoice_order_id 
                        WHERE `time` LIKE '%" . $year . "%'");

                    $income_num = $income->num_rows;
                    $janu=0;
                    $feb=0;
                    $march=0;
                    $april=0;
                    $may=0;
                    $june=0;
                    $july=0;
                    $aug=0;
                    $sep=0;
                    $oct=0;
                    $nov=0;
                    $des=0;
                    for ($i = 1; $i <= $income_num; $i++) {

                        $income_d = $income->fetch_assoc();

                        $sepra = explode("-", $income_d["time"]);
                        $mth = $sepra[1];

                        if ($mth == "01") {
                            $janu = $janu + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }


                        if ($mth == "02") {
                            $feb = $feb + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }


                        if ($mth == "03") {
                            $march = $march + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }


                        if ($mth == "04") {
                            $april = $april + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "05") {
                            $may = $may + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "06") {
                            $june = $june + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "07") {
                            $july = $july + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "08") {
                            $aug = $aug + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "09") {
                            $sep = $sep + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "10") {
                            $oct = $oct + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "11") {
                            $nov = $nov + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }

                        if ($mth == "12") {
                            $des = $des + (int)$income_d["qty"] * (int)$income_d["buy_price"];
                        }
                    }
                    ?>
                         { x: new Date(<?php echo($year) ?>,0), y: <?php echo($janu) ?>},
                         { x: new Date(<?php echo($year) ?>,1), y: <?php echo($feb) ?>},
                         { x: new Date(<?php echo($year) ?>,2), y: <?php echo($march) ?>},
                         { x: new Date(<?php echo($year) ?>,3), y: <?php echo($april) ?>},
                         { x: new Date(<?php echo($year) ?>,4), y: <?php echo($may) ?>},
                         { x: new Date(<?php echo($year) ?>,5), y: <?php echo($june) ?>},
                         { x: new Date(<?php echo($year) ?>,6), y: <?php echo($july) ?>},
                         { x: new Date(<?php echo($year) ?>,7), y: <?php echo($aug) ?>},
                         { x: new Date(<?php echo($year) ?>,8), y: <?php echo($sep) ?>},
                         { x: new Date(<?php echo($year) ?>,9), y: <?php echo($oct) ?>},
                         { x: new Date(<?php echo($year) ?>,10), y: <?php echo($nov) ?>},
                         { x: new Date(<?php echo($year) ?>,11), y: <?php echo($des) ?>},
                ]
            }]
        };
        $("#chartContainer").CanvasJSChart(options1);

    }
</script>