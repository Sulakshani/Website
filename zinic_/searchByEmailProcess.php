<?php

require "connection.php";
$txt = $_POST["txt"];

$serach_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email` LIKE '%" . $txt . "%' ");
$serach_num = $serach_rs->num_rows;

for ($x = 0; $x < $serach_num; $x++) {
    $serach_d = $serach_rs->fetch_assoc();

?>
    <tr>
        <td><?php echo ((int)$x + 1) ?></td>
        <td>
            <?php echo ($serach_d["order_id"]) ?>
        </td>
        <td>
            <?php echo ($serach_d["user_email"]) ?>
        </td>
        <td>
            <?php echo ($serach_d["time"]) ?>
        </td>
        <td>
            <div class="d-grid">
                <?php
                if ($serach_d["a_status"] == 0) {
                ?> <div class="btn btn-success" id="changeOrderStatusBtn<?php echo ($serach_d["order_id"]) ?>" onclick="changeOrderStatus('<?php echo ($serach_d['order_id']) ?>');">Comfirm Order</div><?php
                                                                                                                                                                                                    } else if ($serach_d["a_status"] == 1) {
                                                                                                                                                                                                        ?> <div class="btn btn-primary" id="changeOrderStatusBtn<?php echo ($serach_d["order_id"]) ?>" onclick="changeOrderStatus('<?php echo ($serach_d['order_id']) ?>');">Couriered</div><?php
                                                                                                                                                                                                                                                                                                                                                                                    } else if ($serach_d["a_status"] == 2) {
                                                                                                                                                                                                                                                                                                                                                                                        ?> <div class="btn btn-danger disabled">Deliverd</div><?php
                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>
            </div>
        </td>
        <td class="d-flex justify-content-end">
            <a href="invoice.php?order_id=<?php echo ($serach_d["order_id"]) ?>" class="btn btn-primary">
                <i class="bi bi-eye"></i>
                </diav>
        </td>
    </tr>
<?php

}

?>