<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Purchase History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


</head>

<body>
    <?PHP include "header.php";


    if (isset($_SESSION["u"])) {

        $mail = $_SESSION["u"]["email"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "'");
        $invoice_num = $invoice_rs->num_rows;



    ?>
        <div class="col-12">
            <hr>
            <nav class="ms-3" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Purchase History</li>
                </ol>
            </nav>
            <hr>
        </div>

        <?PHP

        if ($invoice_num == 0) {

        ?>
            <div class="col-12 text-center">
                <h1>Purchase History</h1>
            </div>

            <div class="col-12 text-center">
                <i class="bi bi-hourglass-split" style="font-size: 13rem;"></i>
            </div>
            <div class="col-12 text-center mb-3">
                <button class="btn btn-lg btn-outline-secondary" onclick="window.location = 'home.php';">You have not purchased any item yet</button>
            </div>

        <?PHP

        } else {

        ?>

            <?PHP

            for ($x = 0; $x < $invoice_num; $x++) {

                $invoice_data = $invoice_rs->fetch_assoc();

            ?>

                <div class="col-12">
                    <div class="card mb-3 mx-auto" style="max-width: 740px;">
                        <div class="row g-0">
                            <?PHP


                            $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_image` ON 
                        product.id=product_image.product_id INNER JOIN `user` ON product.user_email=user.email 
                        WHERE `id`='" . $invoice_data["product_id"] . "'");

                            $product_data = $details_rs->fetch_assoc();

                            ?>

                            <div class="col-md-4">
                                <img src="<?PHP echo $product_data["img_path"]; ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8 ">




                                <div class="card-body">
                                    <ul>
                                        <?PHP

                                        if ($invoice_data["status"] == 0) {
                                        ?><p class="badge bg-danger text-dark">Processing</p><?PHP
                                                    } else if ($invoice_data["status"] == 1) {
                                                        ?><p class="badge bg-warning text-dark">Delivered</p><?PHP
                                                                                            } else if ($invoice_data["status"] == 2) {
                                                                                                ?><p class="badge bg-success text-white">Received</p><?PHP
                                                                                            }

                                                                                                ?>
                                        <li>
                                            <h5 class="card-title"><?PHP echo $product_data["title"]; ?></h5>
                                        </li>
                                        <li>
                                            <p class="card-text">Invoice No : <?PHP echo $invoice_data["invoice_id"]; ?></p>
                                        </li>
                                        <li>
                                            <p class="card-text">Order Id : <?PHP echo $invoice_data["order_id"]; ?></p>
                                        </li>
                                        <li>
                                            <p class="card-text">Name : <?PHP echo $_SESSION["u"]["name"]; ?></p>
                                        </li>
                                        <li>
                                            <p class="card-text">Price : Rs.<?PHP echo $product_data["price"]; ?>.00</p>
                                        </li>
                                        <li>
                                            <p class="card-text">Qty : <?PHP echo $invoice_data["qty"]; ?></p>
                                        </li>
                                        <li>
                                            <p class="card-text">Total : Rs.<?PHP echo $invoice_data["total"]; ?>.00</p>
                                        </li>
                                        <li>
                                            <p class="card-text">Date : <?PHP echo $invoice_data["date"]; ?></p>
                                        </li>

                                    </ul>
                                </div>

                                <div class="row mt-2 mb-2 justify-content-center">
                                    <div class="col-5 d-grid">
                                        <button class="btn btn-warning" onclick="feedback('<?PHP echo $product_data['id']; ?>');">Feedback</button>
                                    </div>
                                    <div class="col-5 d-grid">
                                        <button class="btn btn-danger" onclick="removehis('<?PHP echo $invoice_data['order_id']; ?>');">Delete</button>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="modal" tabindex="-1" id="feedback<?PHP echo $product_data["id"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title">Feedbacks</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 text-center">
                                    <h3><?PHP echo $product_data["title"]; ?></h3>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 text-danger">
                                            <input class="form-check-input" type="radio" name="radioNoLabel" id="type1" value="" aria-label="...">
                                            &nbsp; Happy
                                        </div>
                                        <div class="col-4 text-warning">
                                            <input class="form-check-input " type="radio" name="radioNoLabel" id="type2" value="" aria-label="...">
                                            &nbsp;Good
                                        </div>
                                        <div class="col-4 text-success">
                                            <input class="form-check-input " type="radio" name="radioNoLabel" id="type3" value="" aria-label="...">
                                            &nbsp;Very Good
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <input type="text" class="form-control" id="content" placeholder="Enter your feedback...">
                            </div>
                            <div class="modal-footer">
                                <div class="col-12 d-grid">
                                    <button class="btn btn-primary" onclick="sendfeed('<?PHP echo $invoice_data['product_id']; ?>');">
                                        send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?PHP


            }


            ?>


        <?PHP

        }

        ?>


        <?PHP include "footer.php"; ?>
    <?PHP

    } else {

    ?>
        <script>
            window.location = "index.php";
        </script>

    <?PHP
    }


    ?>





    <script src="script.js"></script>
</body>

</html>