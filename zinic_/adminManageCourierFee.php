<?php
require "connection.php";
session_start();

if(isset($_SESSION["au"])){
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Courier Fee | ZINIC</title>
    <link rel="stylesheet" href="chosen.css">
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
    $x = 6;
    include "adminHeader.php";
    ?>

    <div class="container">
        <div class="row">

            <table class="table" style="margin-top: 60px;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">District</th>
                        <th scope="col">Fee (LKR)</th>
                        <th scope="col" style="width: 300px;">Change Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ship_rs = Database::search("SELECT * FROM `shipping` ORDER BY `district` ASC");
                    $ship_num = $ship_rs->num_rows;
                    for ($x = 0; $x < $ship_num; $x++) {
                        $ship_d = $ship_rs->fetch_assoc();
                    ?>
                        <tr>
                            <th scope="row"><?php echo ($x + 1); ?></th>
                            <td><?php echo ($ship_d["district"]); ?></td>
                            <td><?php echo ($ship_d["fee"]); ?></td>
                            <td class="">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="text" class="form-control" id="currentFee<?php echo($ship_d['id']) ?>" placeholder="change fee" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="changeDeliveryFee('<?php echo($ship_d['id']); ?>')">Change</button>
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
}
?>