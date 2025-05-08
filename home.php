<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="resource/icon.ico" />
</head>
<?PHP include "header.php"; ?>

<body style="background-color: white;">


    <div class="container-fluid">

        <div style="background-color: whitesmoke; border-radius: 8px; ">

            <div class="col-12 mt-4 mb-4 pt-3 pb-3 pe-2 ps-2 pe-lg-0 ps-lg-0" style=" border-radius: 8px;">
                <div class="row">
                    <div class="col-12 col-lg-3 text-center text-lg-center  mt-2">
                        <img src="resource/logo.png" class="ms-lg-5" width="170px" />
                        <hr class="d-lg-none d-block mt-3">
                    </div>

                    <div class="col-12 col-lg-6 ms-lg-3 text-end">
                        <div class="input-group mt-3 mb-3 ms-lg-3">
                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt" style="background-color: transparent; border: 1px solid blue;">

                            <select class="form-select" style="max-width: 250px; background-color: transparent; border: 1px solid blue;" id="basic_search_select">
                                <option value="0">All Categories</option>
                                <?PHP
                                $cat_rs = Database::search("SELECT * FROM `category`");
                                $num = $cat_rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {

                                    $cat_data = $cat_rs->fetch_assoc();
                                ?>
                                    <option value="<?PHP echo $cat_data["cat_id"]; ?>"><?PHP echo $cat_data["cat_name"]; ?></option>
                                <?PHP
                                }



                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2 d-grid ms-lg-4 text-end">
                        <button class="btn btn-primary mt-3 mb-3" onclick="basicsearch(0);">Search</button>
                    </div>





                </div>
            </div>

        </div>



        <div id="basicSearchResult" class="overflow-hidden">
            <div class=" row">
                <div class=" row mx-auto">
                    <div class="col-12  mb-3">
                        <div class="row">

                            <div id="carouselExampleIndicators" class="mx-auto col-12 col-lg-10 carousel slide justify-content-center" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resource/03.png" class="d-block img-thumbnail poster-img-1" style="border: none; border-radius: 20px;" />

                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/02.png" class="d-block img-thumbnail poster-img-1" style="border: none; border-radius: 20px;" />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/01.png" class="d-block img-thumbnail poster-img-1" style="border: none; border-radius: 20px;" />

                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                    </div>


                    <div class="col-12 text-center pt-4 pb-4" style="background-color: whitesmoke; border-radius: 20px;">

                        <h2 style="font-family:Grape Nuts;">Sri Lankan Biggest Online Fashion Store.Choose Your Any Fashions.</h2>

                    </div>



                    <div class="container-fluid">
                        <?PHP
                        $cat_rs2 = Database::search("SELECT * FROM `category`");
                        $num2 = $cat_rs2->num_rows;

                        for ($x = 0; $x < $num2; $x++) {

                            $cat_data2 = $cat_rs2->fetch_assoc();
                        ?>
                            <div class="col-12 mt-3 mb-3">

                                <a href="#" class="text-decoration-none text-dark fs-3">
                                    <?php echo $cat_data2["cat_name"]; ?>
                                </a> &nbsp;&nbsp;
                                <a href="#" class="text-decoration-none text-dark fs-6">See All &nbsp;&rarr;</a>
                                <div class="col-12 mb-3">
                                    <div class="row">

                                        <div class="col-12">
                                            <hr>
                                            <div class="row justify-content-center gap-4">

                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $cat_data2["cat_id"] . "' 
                                    AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                                $product_num = $product_rs->num_rows;

                                                for ($z = 0; $z < $product_num; $z++) {
                                                    $product_data = $product_rs->fetch_assoc();
                                                ?>

                                                    <div class="card col-6 col-lg-2 mt-5 mb-5" style="width: 18rem; border: none; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; border-radius: 20px;">

                                                        <?php
                                                        $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
                                                        $img_data = $img_rs->fetch_assoc();
                                                        ?>

                                                        <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 300px; border: none;" />
                                                        <div class="card-body ms-0 m-0 text-center">
                                                            <h5 class="card-title  fs-5"><?php echo $product_data["title"]; ?></h5>

                                                            <span class="card-text text-secondary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                                            <?php
                                                            if ($product_data["qty"] > 0) {

                                                            ?>
                                                                <span class="card-text text-success ">In Stock</span><br />
                                                                <span class="card-text text-primary"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                                <a href='<?php echo "singleproductview.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-warning">Buy Now</a>
                                                                <?PHP

                                                                if (isset($_SESSION["u"])) {
                                                                ?>
                                                                    <button class="col-12 btn btn-dark mt-2" onclick="addtocart(<?PHP echo $product_data['id']; ?>);">
                                                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                                    </button>
                                                                <?PHP
                                                                }

                                                                ?>

                                                            <?php

                                                            } else {
                                                            ?>
                                                                <span class="card-text text-danger ">Out Of Stock</span><br />
                                                                <span class="card-text text-danger ">0 Items Available</span><br /><br />
                                                                <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a>
                                                                <?PHP

                                                                if (isset($_SESSION["u"])) {
                                                                ?>
                                                                    <button class="col-12 btn btn-dark mt-2 disabled">
                                                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                                    </button>
                                                                <?PHP
                                                                }

                                                                ?>
                                                            <?php
                                                            }
                                                            ?>


                                                            <?PHP

                                                            if (isset($_SESSION["u"])) {

                                                            ?>
                                                                <button class="col-12 btn btn-outline-light mt-2 border border-danger" onclick="addtowatchlist(<?PHP echo $product_data['id']; ?>);">
                                                                    <i class="bi bi-heart-fill text-danger fs-5"></i>
                                                                </button>
                                                            <?PHP

                                                            }

                                                            ?>



                                                        </div>
                                                    </div>

                                                <?php
                                                }

                                                ?>



                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr>
                            </div>
                    </div>

                <?PHP
                        }


                ?>
                </div>






            </div>


        </div>

    </div>
    <?PHP include "footer.php"; ?>
    <script src="script.js"></script>


</body>

</html>