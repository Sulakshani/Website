<?php

require "connection.php";
session_start();

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile | ZINIC</title>
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="chosen.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="./logoH.jpeg">
    </head>

    <body class="">
        <?php
        include "header.php";
        ?>
        <div class="container-fluid">
            <div class="row mt-2">

                <div class="col-12 col-lg-4">

                    <?php

                    $profile = Database::search("SELECT * FROM `user` WHERE `email`='$email'");
                    $profile_row = $profile->fetch_assoc();

                    ?>

                    <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                        <img src="<?php if (empty($profile_row["profile_pic"])) {
                            ?>sample/newuser.svg<?php
                        } else {
                            echo ($profile_row["profile_pic"]);
                        } ?>" id="profileImg" srcset=""
                            style="width: 300px; height: 300px; object-fit: cover;">
                        <label for="uppic" class="btn btn-primary">change profile picture</label>
                        <input type="file" id="uppic" class="d-none" onchange="changeProPic()">
                        <div class="btn btn-danger" onclick="logOutProcess()">LogOut</div>
                    </div>

                </div>

                <div class="col-12 col-lg-8 my-2 border-start border-3 border-dark">
                    <div class="row g-2 fw-bold bg-light p-1">

                        <?php
                        $u_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
                        $u_d = $u_rs->fetch_assoc();
                        ?>

                        <div class="col-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fname_userProfile"
                                value="<?php echo ($u_d["fname"]); ?>">
                        </div>
                        <div class="col-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lname_userProfile"
                                value="<?php echo ($u_d["lname"]); ?>">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email_userProfile" readonly
                                value="<?php echo ($u_d["email"]); ?>">
                        </div>
                        <div class="col-12">
                            <label for="mobile1" class="form-label">Mobile Number 1</label>
                            <input type="text" class="form-control" id="mobile1_userProfile" readonly
                                value="<?php echo ($u_d["mobile1"]); ?>">
                        </div>
                        <div class="col-12">
                            <label for="mobile2" class="form-label">Mobile Number 2 (optional)</label>
                            <input type="text" class="form-control" id="mobile2_userProfile" value="<?php if (isset($u_d["mobile2"])) {
                                echo ($u_d["mobile2"]);
                            } ?>">
                        </div>
                        <div class="col-12">
                            <label for="line1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" id="line1_userProfile" value="<?php if (isset($u_d["line1"])) {
                                echo ($u_d["line1"]);
                            } ?>">
                        </div>
                        <div class="col-12">
                            <label for="line2" class="form-label">Address Line 2 (optional)</label>
                            <input type="text" class="form-control" id="line2_userProfile" value="<?php if (isset($u_d["line2"])) {
                                echo ($u_d["line2"]);
                            } ?>">
                        </div>
                        <?php
                        $dis_rs = Database::search("SELECT * FROM shipping");
                        $dis_num = $dis_rs->num_rows;
                        ?>
                        <div class="col-12">
                            <label for="line1" class="form-label">Select Your District</label>
                            <select name="" id="district_userProfile" class="mySelect form-select">
                                <?php
                                for ($x = 0; $x < $dis_num; $x++) {
                                    $dis_d = $dis_rs->fetch_assoc();
                                    ?>
                                    <option value="<?php echo ($dis_d["id"]) ?>" <?php if ($dis_d["id"] == $u_d["shipping_id"]) {
                                           ?> selected <?php
                                       } ?>><?php echo ($dis_d["district"]) ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-12">
                            <label for="pcode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="pcode_userProfile" value="<?php if (isset($u_d["pcode"])) {
                                echo ($u_d["pcode"]);
                            } ?>">
                        </div>

                        <div class="offset-4 col-4 d-grid">
                            <div class="btn btn-success" onclick="updateProfile();">Update</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        include "footer.php";
        ?>
    </body>
    <script src="jQuery 3.6.1.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="chosen.jquery.js"></script>
    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>

    </html>
    <?php
} else {
    header("Location: signIn.php");
}
?>