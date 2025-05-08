<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Track Order</title>
    <link rel="icon" href="resource/icon.ico" />
</head>

<body>

    <?PHP include "adminheader.php" ?>

    <hr>
    <div class="col-12 mt-5 mb-5">
        <div class="row justify-content-center gap-3">

            <?PHP

            $in_rs = Database::search("SELECT * FROM `invoice` WHERE `status` != '2'");
            $in_num = $in_rs->num_rows;



            for ($x = 0; $x < $in_num; $x++) {

                $in_data = $in_rs->fetch_assoc();

                $p_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $in_data["product_id"] . "'");
                $p_data = $p_rs->fetch_assoc();

                $u_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $p_data["user_email"] . "'");
                $u_data = $u_rs->fetch_assoc();

            ?>

                <div class="col-12 col-lg-3 p-4" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <p>Order ID : <?PHP echo $in_data["order_id"]; ?></p>
                    <p>Product Name : <?PHP echo $p_data["title"]; ?></p>
                    <p>Product Price : Rs.<?PHP echo $p_data["price"]; ?>.00</p>
                    <p>Seller Name : <?PHP echo $u_data["name"]; ?></p>

                    <div class="col-12 d-grid">

                        <?PHP

                        if ($in_data["status"] == 0) {
                        ?><button class="btn btn-warning" onclick="changeorderstatus('<?PHP echo $in_data['invoice_id'];?>','<?PHP echo $in_data['status'];?>');">Delivered</button><?PHP
                                                } else if ($in_data["status"] == 1) {
                                                    ?><button class="btn btn-success" onclick="changeorderstatus('<?PHP echo $in_data['invoice_id'];?>','<?PHP echo $in_data['status'];?>');">Received</button><?PHP
                                                                        } 


                                                                            ?>

                    </div>
                </div>

            <?PHP


            }




            ?>
        </div>
    </div>
    <?PHP include "footer.php"; ?>

    <script src="script.js"></script>
</body>

</html>