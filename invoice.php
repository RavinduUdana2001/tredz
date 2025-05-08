<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Invoice</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <?PHP include "header.php";
   

    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];
        $oid = $_GET["id"];



    ?>

        <hr>
        <div class="container">
            <div class="col-12">

                <div class="row mt-3 justify-content-center mb-3">
                    <div class="col-6 col-lg-2 text-center">
                        <button class="btn btn-danger" onclick="printInvoice();"><i class="bi bi-printer"></i>&nbsp;Download Now</button>
                    </div>

                    <div class="col-6 col-lg-2 text-center">
                        <button class="btn btn-success" onclick="sendtoemail();"><i class="bi bi-envelope-check-fill"></i>&nbsp;Send to email</button>
                    </div>
                    
                </div>
               


                <div class="col-12 col-lg-8 mx-auto mb-5" id="page" style="box-shadow: 0 0 8px 0px rgba(0,0,0,0.2); margin: auto;">



                    <div class="col-12">

                        <div class="row ">

                            <div class="col-12 col-lg-7 ms-4 mt-4">

                                <h3>Trendz.</h3>
                                <h6>+94 777 162 263</h6>
                                <h6>trendzinfo@gmail.com</h6>
                                <h6> Kaduruwela, Polonnaruwa, Sri Lanka</h6>
                            </div>


                            <?php

                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");
                            $address_data = $address_rs->fetch_assoc();

                            ?>
                            <div class="col-12 col-lg-4 ms-4 mt-4">

                                <h3>Invoice To:</h3>
                                <h6><?PHP echo $_SESSION["u"]["name"]; ?></h6>
                                <h6><?PHP echo $_SESSION["u"]["email"]; ?></h6>
                                <h6><?PHP echo $_SESSION["u"]["mobile"]; ?></h6>

                            </div>



                        </div>

                    </div>

                    <div class="col-12" style="background-color: whitesmoke;">

                        <?php

                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                        $invoice_data = $invoice_rs->fetch_assoc();



                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();

                        ?>
                        <hr>
                        <div class="row">
                            <div class="col-12 col-lg-7 ms-4 mb-2 mb-lg-0">
                                <h5>Invoice <?PHP echo $invoice_data["invoice_id"]; ?></h5>
                                <h6>Date : <?PHP echo $invoice_data["date"]; ?></h6>
                                <h5>Product : <?PHP echo $product_data["title"]; ?></h5>
                            </div>

                            <div class="col-12 col-lg-4 ms-4">
                                <h5>Order ID : <?PHP echo $oid ?></h5>
                                <h6>Unit Price : Rs.<?PHP echo $product_data["price"]; ?>.00</h6>
                                <h6>Quentity : <?PHP echo $invoice_data["qty"]; ?></h6>

                                <h6>Total : Rs.<?PHP echo $invoice_data["total"]; ?>.00</h6>
                            </div>

                        </div>
                        <hr>
                    </div>

                    <?php

                    $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $address_data["city_city_id"] . "'");
                    $city_data = $city_rs->fetch_assoc();

                    $delivery = 0;

                    if ($city_data["district_district_id"] == 3) {
                        $delivery = $product_data["delivery_fee_colombo"];
                    } else {
                        $delivery = $product_data["delivery_fee_other"];
                    }

                    $grand_total = $invoice_data["total"];
                    $total = $grand_total - $delivery;

                    ?>
                    <div class="col-12 text-center pb-3 b-3">
                        <div class="col-12 col-lg-6 mx-auto text-center">
                            <h5>Sub Total : Rs.<?PHP echo $total ?>.00</h5>
                            <h5>Delivery Fee : Rs.<?PHP echo $delivery ?>.00</h5>

                        </div>
                        <div style="background-color: whitesmoke;">
                            <hr>
                            <h5>Grand Total : Rs.<?PHP echo $grand_total ?>.00</h5>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 text-center">

                        <h2 class="text-success">Thank you!</h2>

                    </div>

                    <div class="col-12 text-center" style="background-color:#80b3ff;">
                        <hr>
                        <p><b>Notice :</b> Purchased items can return befor 14 days of Delivery.</p>
                        <hr>
                    </div>

                </div>

            </div>
        </div>
        <?PHP include "footer.php"; ?>


    <?PHP




    }


    ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>