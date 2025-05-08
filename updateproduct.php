<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trendz | Update product</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />


</head>

<body>

    <?PHP include "header.php"; ?>
    <div class="container-fluid">

    <hr>
        <?php



        


        if (isset($_SESSION["u"])) {

        


                $product = $_SESSION["p"];

        ?>



                <div class="col-12 text-center pb-3 pt-3 mt-0" style="background-color:  whitesmoke;">
                    <h2 class="h2">Update Product</h2>
                </div>
                <div class="row gy-3">




                    <div class="row col-12 col-lg-8 mx-auto mt-5">
                        <div class="col-12 col-lg-6 mb-1 mb-lg-0 mt-4">
                        <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Product Category</label>
                            </div>
                            <select class="form-select" id="category" disabled>
                                
                                <?php
                                $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "'");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>









                        <div class="col-12 col-lg-6 mt-lg-4">
                        <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Product Brand</label>
                            </div>
                            <select class="form-select " id="brand" disabled>
                                
                                <?php
                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` IN 
                                (SELECT `brand_brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                $brand_num = $brand_rs->num_rows;

                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $brand_data["brand_id"]; ?>">
                                        <?php echo $brand_data["brand_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                    </div>



                    <div class="row col-12 col-lg-8 mx-auto mt-5">


                        <div class="col-12 col-lg-6 mb-1 mb-lg-0">
                        <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Product Model</label>
                            </div>
                            <select class="form-select" id="model" disabled>
                                
                                <?php
                                $model_rs = Database::search("SELECT * FROM `model` WHERE `model_id` IN 
                                (SELECT `model_model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                $model_num = $model_rs->num_rows;

                                for ($x = 0; $x < $model_num; $x++) {
                                    $model_data = $model_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $model_data["model_id"]; ?>">
                                        <?php echo $model_data["model_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6 mb-5">


                        <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Product Title</label>
                            </div>
                            <input type="text" class="form-control" id="title" value="<?php echo $product["title"]; ?>"/>




                        </div>





                        <hr>
                    </div>






                    <div class="row col-12 col-lg-8 mx-auto mt-5">

                        <div class="col-12 col-lg-12 mb-1 mb-lg-5">
                        <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Product Colour</label>
                            </div>

                            <select class="col-12 form-select" id="clr" disabled>
                                
                                <?php
                                $clr_rs = Database::search("SELECT * FROM `color` INNER JOIN `product_has_color` ON 
                                color.color_id=product_has_color.color_color_id WHERE `product_id`='".$product["id"]."'");
                                $clr_num = $clr_rs->num_rows;

                                for ($x = 0; $x < $clr_num; $x++) {
                                    $clr_data = $clr_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $clr_data["color_id"]; ?>">
                                        <?php echo $clr_data["color_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>

                        
                        <hr>
                    </div>



                    <div class=" row col-12 col-lg-8 mx-auto mt-5">

                        <div class="col-12 col-lg-6">

                            <div class="col-12">
                                <label class="form-label " style="font-size: 17px;">Add quentity</label>
                            </div>

                            <input type="number" class="form-control" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />



                        </div>

                        <div class="col-12 col-lg-6">

                            <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Cost Per Item</label>
                            </div>


                            <div class="input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="cost" disabled value="<?php echo $product["price"]; ?>"/>
                                <span class="input-group-text">.00</span>
                            </div>

                        </div>

                    </div>



                    <div class="row col-12 col-lg-8 mx-auto mt-5 ">

                        <div class="col-12 col-lg-6">

                            <div class="col-12">
                                <label class="form-label">Delivery cost Within Colombo</label>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="dwc" value="<?php echo $product["delivery_fee_colombo"]; ?>"/>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 mb-5">

                            <div class="col-12 ">
                                <label class="form-label">Delivery cost out of Colombo</label>
                            </div>
                            <div class="col-12 ">
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="doc" value="<?PHP echo $product["delivery_fee_other"];?>"/>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                        </div>
                        <hr>
                    </div>

                    <div class="col-12 mt-5 ">
                        <div class="col-12 col-lg-8 mx-auto mb-5">
                            <div class="col-12">
                                <label class="form-label" style="font-size: 17px;">Product Description</label>
                            </div>
                            <div class="col-12 mx-auto">
                                <textarea cols="30" rows="15" class="form-control" id="desc"><?PHP echo $product["description"];?></textarea>
                            </div>
                        </div>
                        <hr>
                    </div>

                </div>
    </div>

    </div>

    <div class="col-12 ">
        <div class="row mb-5">
            <div class="col-12 col-lg-8 mx-auto">
                <label class="form-label" style="font-size: 17px;">Update Product Images</label>
            </div>
            <div class="offset-lg-3 col-11 mx-auto col-lg-6">

            <?php

                                            $img = array();

                                            $img [0] = "resource/upload.png";
                                            $img [1] = "resource/upload.png";
                                            $img [2] = "resource/upload.png";

                                            $product_img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='".$product["id"]."'");
                                            $product_img_num = $product_img_rs->num_rows;

                                            for($x = 0;$x < $product_img_num;$x++){
                                                $product_img_data = $product_img_rs->fetch_assoc();

                                                $img [$x] = $product_img_data["img_path"];
                                            }
                                            
                                            ?>
                <div class="row">
                    <div class="col-4 border border-primary rounded">
                        <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" id="i0" />
                    </div>
                    <div class="col-4 border border-primary rounded">
                        <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px;" id="i1" />
                    </div>
                    <div class="col-4 border border-primary rounded">
                        <img src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px;" id="i2" />
                    </div>
                </div>
            </div>
            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                <input type="file" class="d-none" multiple id="imageuploader" />
                <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
            </div>
        </div>
        <hr>
    </div>





    <div class="mx-auto col-12 col-lg-8 d-grid mt-5 mb-5">
        <button class="btn btn-dark" onclick="updateProduct();">update Product</button>
    </div>


<?php

         


        } else {
?>
    <script>
        window.location = "index.php";
        alert("You want to signin to access this function.");
    </script>


<?PHP
        }

?>

<?php include "footer.php"; ?>



<script src="script.js"></script>
</body>

</html>