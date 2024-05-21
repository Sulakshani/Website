<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin - <?php
        if($x==1){
            ?>Dashboard<?php
        }else if($x==2){
            ?>Manage Product<?php
        }else if($x==3){
            ?>Add Product<?php
        }else if($x==4){
            ?>Manage User<?php
        }else if($x==5){
            ?>Purchased Product<?php
        }else if($x==6){
            ?>Notification<?php
        }
        ?> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminDashboardMenu" aria-controls="adminDashboardMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="adminDashboardMenu" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Admin Panel</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 1) {
                                            ?>active<?php
                                                } ?>" aria-current="page" href="adminDashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 2) {
                                            ?>active<?php
                                                } ?>" href="adminManageProduct.php">Manage Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 3) {
                                            ?>active<?php
                                                } ?>" href="adminAddProduct.php">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 4) {
                                            ?>active<?php
                                                } ?>" href="adminManageUser.php">Manage User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 5) {
                                            ?>active<?php
                                                } ?>" href="adminPurchasedProduct.php">Purchased Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 6) {
                                            ?>active<?php
                                                } ?>" href="adminManageCourierFee.php">Manage Courier Fee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($x == 7) {
                                            ?>active<?php
                                                } ?>" href="adminNotification.php">Notification</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>