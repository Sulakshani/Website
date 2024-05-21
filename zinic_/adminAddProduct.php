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
    <title>ZINIC | Admin Dashboard</title>
    <link rel="stylesheet" href="chosen.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
$x=3;
include "adminHeader.php";
?>

    <div class="container-fluid">
        <div class="row gy-3 g-2">

            <div class="col-12" style="height: 55px;"></div>

            <div class="col-12">
                <div class="row p-0">
                    <div class="col-12 text-center">
                        <h2 class="text-primary fw-bold h2">Add New Product</h2>
                    </div>
                    <div class="col-12">
                        <div class="row p-0">

                            <div class="col-6">
                                <div class="d-none" role="alert" id="addCatBarndModelAlert">
                                    <span id="addCatBarndModelAlertMsg"></span>
                                    <button type="button" class="btn-close" id="addCatBarndModelAlertCloseBtn" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="offset-6"></div>

                            <div class="col-12 col-lg-4 border-end border-success">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="" class="form-select mySelect text-center" id="AddProductCategory">
                                            <option value="0">Select category</option>

                                            <?php
                                            $cat_rs = Database::search("SELECT * FROM `category`");
                                            $cat_num = $cat_rs->num_rows;
                                            for ($x = 0; $x < $cat_num; $x++) {
                                                $cat_d = $cat_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($cat_d["id"]) ?>"><?php echo ($cat_d["catname"]) ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mt-3">
                                                    <input type="text" id="AddCategory" class="form-control" placeholder="Add Category">
                                                    <div class="btn btn-outline-success" id="AddCategoryBtn"><i class="bi bi-plus"></i>Add</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-lg-4 border-end border-success">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="" class="form-select mySelect text-center" id="AddProductBrand">
                                            <option value="0">Select Brand</option>

                                            <?php

                                            $b_rs = Database::search("SELECT * FROM `brand`");
                                            $b_num = $b_rs->num_rows;

                                            for ($x = 0; $x < $b_num; $x++) {
                                                $b_d = $b_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($b_d["id"]) ?>"><?php echo ($b_d["bname"]) ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mt-3">
                                                    <input type="text" id="AddBrand" class="form-control" placeholder="Add Brand">
                                                    <div class="btn btn-outline-success" id="AddBrandBtn"><i class="bi bi-plus"></i>Add</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="" class="form-select mySelect text-center" id="AddProductModel">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $mod_rs = Database::search("SELECT * FROM `model`");
                                            $mod_num = $mod_rs->num_rows;

                                            for ($x = 0; $x < $mod_num; $x++) {
                                                $mod_d = $mod_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($mod_d["id"]) ?>"><?php echo ($mod_d["mname"]) ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 border border-1 border-danger mt-3 p-2">
                                                <div class="input-group">
                                                    <input type="text" id="AddModel" class="form-control" placeholder="Add Model">
                                                    <div class="btn btn-outline-success" id="AddModelBtn"><i class="bi bi-plus"></i>Add</div>
                                                </div>
                                                <div class=" mt-1">
                                                    <select name="" class="form-select mySelect" id="AddModelBrand">
                                                        <option value="0">Select Model's Brand</option>
                                                        <?php

                                                        $b_rs = Database::search("SELECT * FROM `brand`");
                                                        $b_num = $b_rs->num_rows;

                                                        for ($x = 0; $x < $b_num; $x++) {
                                                            $b_d = $b_rs->fetch_assoc();
                                                        ?>
                                                            <option value="<?php echo ($b_d["id"]) ?>"><?php echo ($b_d["bname"]) ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="bg-success" style="height: 3px;" />
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="fw-bold form-label" style="font-size: 20px;">Add a title to your product</label>
                            </div>
                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                <input type="text" class="form-control" id="AddProductTitel">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="bg-success" style="height: 3px;" />
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-lg-4 border-end border-success">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class=" form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-check-inline mx-5">
                                            <input class="form-check-input" type="radio" id="AddProductB" value="option1" name="con" checked>
                                            <label class="form-check-label fw-bold" for="AddProductB">Brand New</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="AddProductU" value="option2" name="con">
                                            <label class="form-check-label fw-bold" for="AddProductU">Used</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 border-end border-success">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class=" form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                    </div>
                                    <div class="col-12">

                                        <select name="" class="form-select mySelect" id="AddProductClr">
                                            <option value="0">Select Colour</option>
                                            <?php

                                            $clr_rs = Database::search("SELECT * FROM `colour`");
                                            $clr_num = $clr_rs->num_rows;

                                            for ($x = 0; $x < $clr_num; $x++) {
                                                $clr_d = $clr_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo ($clr_d["id"]) ?>"><?php echo ($clr_d["colour"]) ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>

                                    </div>

                                    <div class="col-12">
                                        <div class="input-group my-2">
                                            <input type="text" class="form-control" id="clr_in" placeholder="Add new colour">
                                            <span class="btn btn-outline-primary" id="newColorAdd">+ Add</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="" class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="number" class="form-control" value="0" min="0" id="AddProductQty">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="bg-success" style="height: 3px;" />
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-6 border-end border-success">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="fw-bold form-label" style="font-size: 20px;">Cost Per Item</label>
                                    </div>
                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                        <div class="input-group my-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" id="AddProductCost">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Appruved Payment Methods</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row mx-1 mx-lg-0">
                                            <div class="offset-0 offset-lg-2 col-3 col-lg-2">
                                                <img src="resource/payment_method/visa_img.png" alt="" style="width: 50px;height: 50px; object-fit: contain;">
                                            </div>
                                            <div class="col-3 col-lg-2 pm pm2">
                                                <img src="resource/payment_method/paypal_img.png" style="width: 50px;height: 50px; object-fit: contain;">
                                            </div>
                                            <div class="col-3 col-lg-2 pm pm3">
                                                <img src="resource/payment_method/mastercard_img.png" style="width: 50px;height: 50px; object-fit: contain;">
                                            </div>
                                            <div class="col-3 col-lg-2 pm pm4">
                                                <img src="resource/payment_method/american_express_img.png" style="width: 50px;height: 50px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="bg-success" style="height: 3px;" />
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                            </div>
                            <div class="col-12">
                                <textarea cols="30" rows="15" class="form-control" id="AddProductDes"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr class="bg-success" style="height: 3px;" />
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">

                                <div class="d-none" id="imageUploadErrorMsg" role="alert">
                                    <strong>Error!</strong> Please Upload 3 or less than 3 images!
                                    <button type="button" class="btn-close" aria-label="Close" id="imageUploadErrorMsgClose"></button>
                                </div>

                                <label for="" class="form-label fw-bold" style="font-size: 20px;">Add Product Image</label>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/addproductimg.svg" class="img-fluid" id="uploaded_img0" style="width: 250px;">
                                    </div>
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/addproductimg.svg" class="img-fluid" id="uploaded_img1" style="width: 250px;">
                                    </div>
                                    <div class="col-4 border border-primary rounded">
                                        <img src="resource/addproductimg.svg" class="img-fluid" id="uploaded_img2" style="width: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                <input type="file" class="d-none" id="imageuploadFiles" multiple />
                                <label for="imageuploadFiles" class="col-12 btn btn-primary" id="imageuploader"">Upload Images</label>
                            </div>
                        </div>
                    </div>

                                 <div class=" col-12">
                                    <hr class="bg-success" style="height: 3px;" />
                            </div>

                            <div class="d-none" role="alert" id="saveAddProductAlert">
                                <span id="saveAddProductAlertMsg"></span>
                                <button type="button" class="btn-close" id="saveAddProductAlertCloseBtn" aria-label="Close"></button>
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid my-3">
                                <button class="btn btn-success" id="saveProduct">Save Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="jQuery 3.6.1.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="chosen.jquery.js"></script>
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