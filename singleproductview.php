<?PHP



if (isset($_GET["id"])) {

    $pid = $_GET["id"];





?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?PHP include "header.php"; ?>

        <?PHP
        $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
product.category_cat_id,product.model_has_brand_id,
product.status_status_id,product.user_email,model.model_name AS mname,brand.brand_name AS bname FROM 
`product` INNER JOIN `model_has_brand` ON model_has_brand.id=product.model_has_brand_id INNER JOIN 
`brand` ON brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

        $product_num = $product_rs->num_rows;
        if ($product_num == 1) {

            $product_data = $product_rs->fetch_assoc();
        }
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <title><?php echo $product_data["title"]; ?> | Trendz</title>
        <link rel="icon" href="resource/icon.ico" />
    </head>

    <body>




        <div class="container-fluid">


            <div class="row">
                <div class="col-12 col-lg-6 mt-4" style="box-shadow: 0 0 8px 0px rgba(0,0,0,0.2);">

                    <?PHP
                    $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $pid . "'");
                    $image_num = $image_rs->num_rows;
                    $img = array();
                    $image = array();


                    for ($y = 0; $y < $image_num; $y++) {
                        $img_data = $image_rs->fetch_assoc();
                        $image[$y] = $img_data["img_path"];
                    }

                    ?>


                    <div class="col-12 mt-3  mx-auto" id="mainImg" style="height: 340px;
    background-image: url('<?PHP echo $image[0]; ?>');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;">

                    </div>


                    <div class="row">
                        <?php


                        if ($image_num != 0) {
                            for ($x = 0; $x < $image_num; $x++) {
                                $image_data = $image_rs->fetch_assoc();

                        ?>
                                <div class="col-4 col-lg-3 ms-lg-5 mb-3 mt-3">

                                    <img src="<?PHP echo $image[$x]; ?>" alt="image" class="img-fluid border border-dark" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" height="200px" />
                                </div>

                            <?PHP
                            }
                        } else {
                            ?>
                            <div class="col-4 col-lg-3 ms-lg-5 mb-3">
                                <img src="resource/notimage.png" alt="image" class="img-thumbnail" />
                            </div>
                            <div class="col-4 col-lg-3 ms-lg-5 mb-3">
                                <img src="resource/notimage.png" alt="image" class="img-thumbnail" />
                            </div>
                            <div class="col-4 col-lg-3 ms-lg-5 mb-3">
                                <img src="resource/notimage.png" alt="image" class="img-thumbnail" />
                            </div>

                        <?PHP
                        }
                        ?>
                    </div>

                </div>




                <div class="col-12 col-lg-6 mt-2 mb-5">
                    <hr>
                    <div class="col-11 mx-auto">

                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                <?PHP
                                $cat_rs = Database::search("SELECT * FROM `category` INNER JOIN `product` ON category.cat_id=product.category_cat_id WHERE `id` = '" . $pid . "'");

                                $cat_data = $cat_rs->fetch_assoc();






                                ?>



                                <li class="breadcrumb-item active" aria-current="page"><?PHP echo $cat_data["cat_name"]; ?> / <?php echo $product_data["bname"]; ?> / <?php echo $product_data["mname"]; ?></li>

                            </ol>
                        </nav>

                    </div>
                    <hr>


                    <div class="col-12 ms-3">

                        <h3><?php echo $product_data["title"]; ?></h3>
                    </div>
                    <div class="row ms-1">

                        <?php

                        $new_price = $product_data["price"];
                        $adding_price = ($new_price / 100) * 10;
                        $price = $new_price - $adding_price;


                        ?>
                        <div class="col-12 mt-3">
                            <span class="fs-4">Rs.<?PHP echo $price ?>.00</span>
                            &nbsp;&nbsp; | &nbsp;&nbsp;
                            <span class="fs-4 text-danger text-decoration-line-through">
                                Rs.<?PHP echo $new_price ?>.00
                            </span>

                            <span class="fs-4 text-black-50">(-10%)</span>
                        </div>
                    </div>

                    <div class="row ms-1 mt-3">
                        <div class="col-1 mt-2 d-none d-lg-block">
                            <img src="resource/notice.png" alt="notice" width="30px" />
                        </div>
                        <div class="col-12 col-lg-8 ms-lg-2 mt-2">
                            <h6> 14 days free & easy return</h6>

                        </div>

                    </div>

                    <div class="row col-12 mt-4">
                        <div class="col-7 col-lg-6">
                            <h5 class="ms-3 text-success"><?PHP echo $product_data["qty"]; ?>&nbsp;Items Available.</h5>
                        </div>
                        <div class="col-12 col-lg-6 text-start ms-2 ms-lg-0 text-lg-end">
                            <span class="badge">
                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                <i class="bi bi-star-fill text-warning fs-5"></i>

                                &nbsp;&nbsp;&nbsp;

                                <label class="fs-6 text-dark fw-bold">4.5 Rating</label>
                            </span>
                        </div>
                    </div>

                    <div class="col-12 mt-4 ms-3">
                        <div class="row">
                            <div class="col-3 col-lg-2">
                                <span>Quantity : </span>
                            </div>
                            <div class=" col-8 col-lg-9 d-grid">
                                <input type="number" class=" text-start" pattern="[0-9]" value="1" id="qty_input" />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <?php
                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                        $seller_data = $seller_rs->fetch_assoc();
                        ?>
                        <div class="col-6">
                            <h5 class="ms-3 mt-1">Seller : <?PHP echo $seller_data["name"]; ?></h5>
                        </div>



                    </div>
                    <hr>
                    <div class="row ms-1 ms-lg-0">
                        <div class="col-12 col-lg-6">
                            Delivery fee in Colombo : Rs.<?PHP echo $product_data["delivery_fee_colombo"]; ?>.00
                        </div>
                        <div class="col-12 col-lg-6 text-lg-end">
                            Delivery fee outof Colombo : Rs.<?PHP echo $product_data["delivery_fee_other"]; ?>.00
                        </div>
                    </div>
                    <div class="row mb-2 mt-3">
                        <div class="col-12 col-lg-4 d-grid mt-1">
                            <button class="btn btn-warning" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                        </div>
                        <div class="col-12 col-lg-4 d-grid mt-1">
                            <button class="btn btn-dark" onclick="addtocart(<?PHP echo $product_data['id']; ?>);">Add To Cart</button>
                        </div>
                        <div class="col-12 col-lg-4 d-grid mt-1">
                            <button class="btn btn-danger" onclick="addtowatchlist(<?PHP echo $product_data['id']; ?>);">Add To Watchlist</button>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="col-12 row mb-4">

                    <div class="col-12 col-lg-6">
                        <label for="floatingTextarea2 ms-lg-1">Description :</label>
                        <textarea class="form-control" placeholder="<?PHP echo $product_data["description"]; ?>" id="floatingTextarea2" style="height: 200px"></textarea>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="floatingTextarea2 ms-lg-1">Feedbacks :</label>
                        <div class="col-12 row border border-1 border-dark rounded overflow-scroll me-0 ms-1 d-grid" style="height: 200px;">
                            <?PHP

                            $feed_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $pid . "' ");
                            $feed_num = $feed_rs->num_rows;




                            for ($z = 0; $z < $feed_num; $z++) {

                                $feed_data = $feed_rs->fetch_assoc();
                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $feed_data["user_email"] . "' ");
                                $user_data = $user_rs->fetch_assoc();

                            ?>

                                <div class="col-12 mt-1 mb-1 mx-1">
                                    <div class="row border border-1 border-secondary rounded me-0" style="height: 100px; background-color: whitesmoke;">
                                        <div class="row">
                                            <div class="col-5">
                                                <span><?PHP echo $user_data["name"]; ?></span>
                                            </div>
                                            <?PHP

                                            if ($feed_data["type"] == 1) {
                                            ?>
                                                <div class="col-7 text-end">
                                                    <span class="badge"><i class="bi bi-star-fill text-warning fs-5"></i>

                                                    </span>
                                                    1/3
                                                </div>
                                            <?PHP
                                            } else if ($feed_data["type"] == 2) {
                                            ?>
                                                <div class="col-7 text-end">
                                                    <span class="badge"><i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>

                                                    </span>
                                                    2/3
                                                </div>
                                            <?PHP
                                            } else if ($feed_data["type"] == 3) {
                                            ?>
                                                <div class="col-7 text-end">
                                                    <span class="badge"><i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>


                                                    </span>
                                                    3/3
                                                </div>
                                            <?PHP
                                            }

                                            ?>




                                        </div>

                                        <div class="col-12">
                                            <span><?PHP echo $feed_data["feed"]; ?></span>
                                        </div>
                                        <div class="col-12 text-end">
                                            <span><?PHP echo $feed_data["date"]; ?></span>
                                        </div>


                                    </div>
                                </div>

                            <?PHP


                            }



                            ?>





                        </div>
                    </div>












                </div>
                <div class="modal" tabindex="-1" id="message">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: whitesmoke;">
                                <h5 class="modal-title fs-3">Start Chat Here...</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>To : <?PHP echo $seller_data["name"]; ?></h5>
                                <div class="row mt-3">
                                    <div class="col-10 d-grid">
                                        <input type="text" class="form-control" placeholder="Enter your message..." style="border: 1px solid black;" id="msg" />
                                    </div>
                                    <div class="col-2 d-grid">
                                        <button class="btn btn-primary" style="border: 1px solid black;" onclick="sendmsg('<?PHP echo $seller_data['email']; ?>');"><i class="bi bi-send-check"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>

            <?PHP




        }

            ?>

            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


    </body>

    </html>
    <?PHP



    include "footer.php";
    ?>