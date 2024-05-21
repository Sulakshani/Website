<?php
if (isset($_GET["in"])) {
    $in = $_GET["in"];
} else {
    $in = "home";
}
?>

<ul class="nav nav-tabs mb-2">
    <li class="nav-item">
        <a class="nav-link <?php
                            if ($in == "home") {
                            ?>active<?php
                                }
                                    ?> text-dark" href="index.php?in=home">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php
                            if ($in == "shop") {
                            ?>active<?php
                                }
                                    ?> text-dark" href="shop.php?in=shop">Shop</a>
    </li>
</ul>