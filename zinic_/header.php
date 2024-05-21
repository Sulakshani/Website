<head>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .navbar a {
            position: relative;
            font-size: 1.5em;
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            margin-left: 20px;

        }

        .navbar a:hover {
            color: #0ef;
        }

        .navbar a::before {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 0;
            height: 2px;
            background: #0ef;
            transition: .3s;
        }

        .navbar a:hover::before {
            width: 100%;
        }


        /* Hover effect for the icons */
        .shopping-icons a:hover {
            transform: translateY(-5px);
            /* Move the icon up on hover */
        }

        .shopping-icons a {
            color: #fff;
            /* Set the color of the icons */
            text-decoration: none;
            /* Remove underline */
            transition: transform 0.3s ease-in-out;
            /* Smooth transition on hover */
            display: inline-block;
            position: relative;
            font-size: 24px;
            /* Set the font size of the icons */
        }

        .shopping-icons .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>


<nav class="navbar-default navbar-dark bg-dark my-1 py-3 ">
    <div class="container-fluid">
        <div class="row g-1">
            <div class="col-2 col-lg-3 col-xl-3 btn-group d-flex align-items-center">
                <a href="index.php" class="d-flex align-items-center">
                    <img src="./logoMain.jpeg" class="rounded-circle my-1" alt="" style="width: 50px; height: 50px; object-fit: contain;">
                    <span class="navbar-brand d-none d-lg-block " style="color: #E89105;"><strong>ZINIC</strong>&nbsp;TECH</span>
                </a>
            </div>

            <div class="col-12 col-lg-6 col-xl-6 my-auto d-none d-lg-block">
                <nav class="navbar d-flex offset-3 col-6 justify-content-around">
                    <a href="index.php" class="<?php if($x==1){echo 'text-info';} ?>">Home</a>
                    <a href="shop.php" class="<?php if($x==2){echo 'text-info';} ?>"><span>Shop</span></a>
                    <a href="services.php" class="<?php if($x==3){echo 'text-info';} ?>"><span>Services</span></a>
                    <a href="about.php" class="<?php if($x==4){echo 'text-info';} ?>"><span>About</span></a>
                </nav>

            </div>
            <div class="col-10 col-lg-3 col-xl-3 my-auto d-flex justify-content-end">
                <div class="btn-group">
                    <?php
                    if (isset($_SESSION["u"])) {

                        $email = $_SESSION["u"]["email"];

                        $w_rs = Database::search("SELECT * FROM watchlist WHERE `user_email`='" . $email . "'");
                        $w_num = $w_rs->num_rows;

                        $c_rs = Database::search("SELECT * FROM cart WHERE `user_email`='" . $email . "'");
                        $c_num = $c_rs->num_rows;

                        // Check if the user has a profile photo
                        $profile_photo = "default_avatar.jpg"; // Default profile photo
                        $profile_photo_rs = Database::search("SELECT profile_pic FROM user WHERE email='" . $email . "'");
                        if ($profile_photo_rs && $profile_photo_rs->num_rows > 0) {
                            $profile_photo_row = $profile_photo_rs->fetch_assoc();
                            $profile_photo = $profile_photo_row["profile_pic"];
                        }
                    ?>
                        <span class="shopping-icons align-items-baseline">

                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Purchase Items">
                                <a href="purchaseHistory.php" class="ms-1"><i class="bi bi-cart-check"></i></a>
                            </span>
                            <span class="d-inline-block position-relative" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="My Watchlist">
                                <a href="watchlist.php" class="mx-1"><i class="bi bi-heart"></i><span id="watchlistCount" class="badge"><?php echo ($w_num) ?></span></a>
                            </span>
                            <span class="d-inline-block position-relative" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="My Cart">
                                <a href="cart.php" class=""><i class="bi bi-cart"></i><span id="cartCount" class="badge"><?php echo ($c_num) ?></span></a>
                            </span>

                            <a href="userProfile.php" class="mx-4">
                                <?php if ($profile_photo != "") { ?>
                                    <img src="<?php echo $profile_photo; ?>" width="35px" alt="Profile Photo" class="avatar-img">
                                <?php } else { ?>
                                    <i class="bi bi-person-check"></i> <!-- Default icon if no profile photo -->
                                <?php } ?>
                            </a><?php
                            } else {
                                ?><a href="signIn.php" class="avatar-img px-3 py-2 mx-3" style="background:#E89105; border-radius:10px;">
                                <i class="bi bi-person-add" style="font-size:larger; color:white; font-weight:500">Log in</i>
                            </a><?php
                            }

                                ?>
                        </span>
                </div>
            </div>
        </div>

    </div>
</nav>




<div class="offcanvas offcanvas-bottom bg-light" tabindex="-1" id="searchItems" aria-labelledby="offcanvasBottomLabel" style="height: 50vh;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Here what we got</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <div class="row justify-content-center gap-1" id="searchItemView">

        </div>
    </div>
</div>

<script>
    // Enable Bootstrap popover
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>