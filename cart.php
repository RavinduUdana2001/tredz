<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <?PHP include "header.php"; ?>
    <div class="container-fluid">

        <?PHP





        if (isset($_SESSION["u"])) {

            $email = $_SESSION["u"]["email"];

            $total = 0;
            $subtotal = 0;
            $shipping = 0;

        ?>

            <div class="col-12">
                <hr>
                <nav class="ms-3" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">cart</li>
                    </ol>
                </nav>
                <hr>
            </div>

           


            <?PHP
            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "'");
            $cart_num = $cart_rs->num_rows;


            if ($cart_num == 0) {

            ?>
                <div class="col-12 text-center">
                    <i class="bi bi-cart-plus-fill" style="font-size: 15rem;"></i>
                </div>
                <div class="col-12 text-center mb-5">
                    <button class="btn btn-lg btn-outline-secondary" onclick="window.location = 'home.php';">No selected products</button>
                </div>
            <?PHP
            } else {
            ?>
                <div class="col-12">
                    <div class="col-12 col-lg-6">

                    </div>
                </div>




                <div class="col-12 ">
                    <div class="row mx-auto mb-5">




                        <?PHP


                        for ($x = 0; $x < $cart_num; $x++) {


                            $cart_data = $cart_rs->fetch_assoc();

                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_image`
                                        ON product.id = product_image.product_id WHERE `id` = '" . $cart_data["product_id"] . "'");


                            $product_data = $product_rs->fetch_assoc();

                            $total = $total + ($product_data["price"] * $cart_data["qty"]);


                            $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON
                                        user_has_address.city_city_id=city.city_id INNER JOIN `district` ON
                                        city.district_district_id=district.district_id WHERE `user_email`='" . $email . "'");

                            $address_num = $address_rs->num_rows;

                            if ($address_num == 1) {
                                $address_data = $address_rs->fetch_assoc();

                                $ship = 0;

                                if ($address_data["did"] == 3) {
                                    $ship = $product_data["delivery_fee_colombo"];
                                    $shipping = $shipping + $ship;
                                } else {
                                    $ship = $product_data["delivery_fee_other"];
                                    $shipping = $shipping + $ship;
                                }


                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                $seller = $seller_data["name"];
                            } else {

                        ?>

                                <script>
                                    alert("Update Address Details.");
                                    window.location = "userprofile.php";
                                </script>

                            <?PHP
                            }

















                            ?>


                            <div class="col-12 col-lg-6 mt-3 mx-auto">
                                <div class="card mb-3 mx-auto" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4 text-center text-lg-start">
                                            <img src="<?PHP echo $product_data["img_path"]; ?>" class="img-fluid rounded-start" alt="image" style="height: 200px;">
                                        </div>
                                        <div class="col-1 mt-1 ms-3 d-none d-lg-block" style="border-left: 1px solid grey;height: 230px;"></div>
                                        <div class="col-md-6">
                                            <div class="card-body text-center text-lg-start">
                                                <h4 class="card-title"><?PHP echo $product_data["title"]; ?></h4>
                                                <h5 class="card-text">Rs.<?PHP echo $product_data["price"]; ?>.00</h5>


                                                <h6 class="card-text text-success"><?PHP echo $product_data["qty"]; ?> Items in stock<h6>

                                                        <span>Quentity:</span>
                                                        <input type="number" value="<?PHP echo $cart_data["qty"]; ?>" class="mt-1" />

                                                        <p class="card-text mt-1">Delivery fee : Rs.<?PHP echo $ship ?>.00</p>


                                            </div>

                                        </div>
                                        <hr>
                                        <div class="col-7 col-lg-5 text-end">
                                            <h5>Item total : Rs.<?PHP echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</h5>
                                        </div>
                                        <hr>
                                        <div class="row mx-auto col-12">
                                            <button class="btn btn-outline-warning mt-2 mb-2" onclick="window.location= '<?php echo "singleproductview.php?id=" . ($product_data['id']); ?>';">
                                                Buy now
                                            </button>

                                            <button class="btn btn-outline-danger mb-2" onclick="removecart('<?PHP echo $product_data['id'] ?>');">
                                                Remove
                                            </button>
                                        </div>
                                    </div>






                                </div>

                            </div>




                        <?PHP


                        }

                        ?>








                    </div>
                    <div class="col-12 col-lg-9 mb-3 mx-auto mt-3" style="box-shadow: 0 0 8px 0px rgba(0,0,0,0.2); height: 405px;">



                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-outline-light text-black" style="font-size: 26px;"> <i class="bi bi-cart-check-fill" style="font-size: 2rem;"></i>&nbsp;Summery</button>
                        </div>
                        <hr>
                        <ul>
                            <li>
                                <h5>(<?PHP echo $cart_num; ?>) Items</h5>
                            </li>
                            <li>
                                <h5 class="mt-3">Rs.<?PHP echo $total; ?>.00</h5>
                            </li>
                            <li>
                                <h5 class="mt-3">Shipping : Rs.<?php echo $shipping; ?>.00</h5>
                            </li>

                        </ul>
                        <div class="col-12" style="background-color: whitesmoke;">
                            <hr>
                            <h4 class="ms-3 text-center">Total : Rs.<?php echo $total + $shipping; ?>.00</h4>

                            <hr>
                        </div>
                        <div class="col-12 col-lg-9 d-grid mb-3 mt-5 mx-auto">
                            <button class="btn btn-outline-primary" onclick="cartbuy('<?PHP echo $total + $shipping;?>');">Checkout</button>
                        </div>






                    </div>
                </div>





































            <?PHP




            }

            ?>








            <?PHP include "footer.php"; ?>
    </div>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>


<?PHP

        } else {

?>

    <script>
        window.location = "index.php";
    </script>

<?PHP

        }



?>