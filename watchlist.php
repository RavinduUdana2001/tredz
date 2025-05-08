<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Watchlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <?PHP include "header.php"; ?>
    <div class="container-fluid">

        <?PHP

       

        $email = $_SESSION["u"]["email"];

        if (isset($_SESSION["u"])) {


            $watchlist_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON 
            watchlist.product_id=product.id INNER JOIN `user` ON 
            product.user_email=user.email WHERE watchlist.user_email='" . $email . "'");

            $watchlist_num = $watchlist_rs->num_rows;

        ?>

            <div class="col-12">
                <hr>
                <nav class="ms-3" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                    </ol>
                </nav>
                <hr>
            </div>

           
            

            <?PHP

            if ($watchlist_num == 0) {

            ?>
                <div class="col-12 text-center">
                    <i class="bi bi-calendar-heart-fill" style="font-size: 15rem;"></i>

                </div>
                <div class="col-12 text-center mb-5">
                    <button class="btn btn-lg btn-outline-secondary" onclick="window.location = 'home.php';">No selected products</button>
                </div>


            <?PHP
            } else {

            ?>
                
                    <div class="row mx-auto mb-5">
                        <?PHP
                        for ($x = 0; $x < $watchlist_num; $x++) {

                            $watchlist_data = $watchlist_rs->fetch_assoc();


                        ?>


<div class="col-12 col-lg-4">

                            <div class="card mx-auto  mt-3 mb-3" style="width: 18rem;">

                                <?php


                                $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $watchlist_data["product_id"] . "'");
                                $img_data = $img_rs->fetch_assoc();

                                ?>

                                <img src="<?PHP echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail" alt="product image" style="height: 330px;">
                                <div class="card-body">
                                    <h5 class="card-title"><?PHP echo $watchlist_data["title"]; ?></h5>
                                    <p class="card-text">Rs.<?PHP echo $watchlist_data["price"]; ?>.00</p>
                                    <p><?PHP echo $watchlist_data["qty"]; ?> Items in stock</p>
                                    <hr>
                                    <div class="col-12 d-grid mb-1">
                                        <button class="btn btn-outline-warning" onclick="window.location = '<?php echo "singleproductview.php?id=" . ($watchlist_data['id']); ?>'">Buy now</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 d-grid">
                                            <button class="btn btn-outline-dark" onclick="addtocart(<?PHP echo $watchlist_data['id']; ?>);"><i class="bi bi-cart-dash-fill"></i></button>
                                        </div>
                                        <div class="col-6 d-grid">
                                            <button class="btn btn-outline-danger" onclick="removewatch('<?PHP echo $watchlist_data['id'];?>');">Remove</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

</div>

                        <?PHP

                        }



                        ?>





                    </div>

                

            <?PHP

            }



            ?>




            <?PHP include "footer.php"; ?>
    </div>
    <script src="script.js"></script>
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