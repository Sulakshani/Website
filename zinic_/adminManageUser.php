<?php
session_start();
require "connection.php";

if(isset($_SESSION["au"])){
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZINIC | Admin Dashboard</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="./logoH.jpeg">
    <style>
        body{
            background-color: white;
        }
    </style>
</head>

<body>

    <?php
    $x = 4;
    include "adminHeader.php";
    ?>

    <div class="container-fluid">
        <div class="row mx-1">

            <div class="col-12" style="height: 55px;"></div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Purchases </th>
                        <th>More</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $u_rs = Database::search("SELECT * FROM user");
                    $u_num = $u_rs->num_rows;
                    for ($x = 0; $x < $u_num; $x++) {
                        $u_d = $u_rs->fetch_assoc();

                        $u_p_rs = Database::search("SELECT * FROM `invoice` 
                    INNER JOIN `invoice_item` ON invoice.order_id=invoice_item.invoice_order_id 
                    WHERE user_email='" . $u_d["email"] . "' ");

                        $u_p_num = $u_p_rs->num_rows;
                        $totle = 0;
                        for ($y = 0; $y < $u_p_num; $y++) {
                            $u_p_d = $u_p_rs->fetch_assoc();
                            $totle = $totle + (int)$u_p_d["qty"] * (int)$u_p_d["buy_price"];
                        }

                    ?>

                        <tr>
                            <td><?php echo ((int)$x + 1) ?></td>
                            <td>
                                <?php echo ($u_d["fname"] . " " . $u_d["lname"]) ?>
                            </td>
                            <td>
                                <?php echo ($u_d["email"]) ?>
                            </td>
                            <td>
                                <?php echo ($totle) ?>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="adminUserView.php?u_email=<?php echo ($u_d["email"]) ?>" class="btn btn-success"><i class="bi bi-eye"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-12 d-grid">
                                        <div class="btn <?php if ($u_d["a_status"] == 0) {
                                                        ?>btn-primary<?php
                                                                } else {
                                                                    ?>btn-danger<?php
                                                                        } ?>" id="userBlockUnblockBtn<?php echo($u_d["email"]) ?>" onclick="blockUnblockUser('<?php echo ($u_d['email']) ?>');"><?php if ($u_d["a_status"] == 0) {
                                                                                                                                        ?> Unblock <?php
                                                                                                                                                } else {
                                                                                                                                                    ?> Block <?php
                                                                                                                                                        } ?></div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    <?php
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src="jQuery 3.6.1.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>

<?php
}
?>