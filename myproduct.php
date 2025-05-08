<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | My products</title>
    <link rel="icon" href="resource/icon.ico" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">

        <div class="col-12  pb-2 pt-2 mt-3" style="background-color:  whitesmoke;">
            <div class="row">
                <div class="col-12 col-lg-1 text-center text-lg-start ms-lg-3">

                    <?PHP

                    session_start();
                    $email = $_SESSION["u"]["email"];

                    include "connection.php";


                    if (isset($_SESSION["u"])) {


                        $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");
                        $profile_img_num = $profile_img_rs->num_rows;

                        if ($profile_img_num == 1) {
                            $profile_img_data = $profile_img_rs->fetch_assoc();
                    ?>

                            <img src="<?PHP echo $profile_img_data["path"]; ?>" alt="user" class="ms-lg-5 rounded-circle" style="width: 80px; height:80px;" />

                        <?PHP
                        } else {
                        ?>
                            <img src="resource/user.png" alt="user" class="ms-lg-5" style="width: 90px;" />
                        <?PHP
                        }



                        ?>

                </div>
                <div class="col-12 col-lg-4 ms-lg-4 mt-lg-4 text-center text-lg-start">
                <label><?PHP echo $_SESSION["u"]["name"] ?></label><br>
                    <label><?PHP echo $_SESSION["u"]["email"] ?></label>
                </div>
                <div class="col-12 col-lg-3 mt-3 text-center text-lg-start">
                    <h2 class="text-dark">My Products</h2>
                </div>
                <div class="col-12 col-lg-3 mt-3 text-center ms-lg-3 text-lg-end">

                    <button class="btn btn-outline-dark btn-lg" onclick="window.location = 'addproduct.php';">Add New Product</button>
                </div>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-lg-4 mt-3 mb-4 ms-lg-3" style=" height:530px; box-shadow: 0 0 8px 0px rgba(0,0,0,0.2);">

                <hr>
                <h3 class="text-center">Sort Products</h3>
                <hr>

                <div class="col-11 mx-auto">
                    <input type="text" class="form-control btn-outline-dark" id="s" value="" placeholder="Search..." />
                </div>
                <div class="row mx-auto">

                    <div class="col-5 mt-5 mx-auto">
                        <h6>
                            Active time
                        </h6>
                        <hr>
                        <div class="col-12 ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="n">
                                <label class="form-check-label" for="n">
                                    Newest to oldest
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="o">
                                <label class="form-check-label" for="o">
                                    Oldest to newest
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-1 mt-5 " style="border-left: 1px solid grey;height: 130px;"></div>

                    <div class="col-5 mt-5">
                        <h6>
                            By quentity
                        </h6>
                        <hr>
                        <div class="col-12 ">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="h">
                                <label class="form-check-label" for="h">
                                    High to low
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="r1" id="l">
                                <label class="form-check-label" for="l">
                                    Low to high
                                </label>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row mx-auto mt-5">
                    <div class="col-6 d-grid">

                        <button class="btn btn-primary" onclick="sort(0);">Sort</button>

                    </div>
                    <div class="col-6 d-grid">

                        <button class="btn btn-warning" onclick="clearSort();">Clear</button>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7 mx-auto" id="sort">

                <div class="row justify-content-center">

                    <?PHP

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "'");
                        $product_num = $product_rs->num_rows;

                        $results_per_page = 2;
                        $number_of_pages = ceil($product_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' 
LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;
                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();
                    ?>


                        <div class="card mb-3 mt-3 col-8">
                            <div class="row ">
                                <div class="col-md-4 mt-2 text-center">

                                    <?php
                                    $product_img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $selected_data["id"] . "'");
                                    $product_img_data = $product_img_rs->fetch_assoc();
                                    ?>
                                    <img src="<?php echo $product_img_data["img_path"]; ?>" class="img-fluid rounded-start img-thumbnail" style="height: 190px;" />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title "><?php echo $selected_data["title"]; ?></h5>
                                        <span class="card-text text-dark mt-2">Rs.<?php echo $selected_data["price"]; ?>.00</span><br />
                                        <span class="card-text text-primary mt-3"><?php echo $selected_data["qty"]; ?> Items left</span>
                                        <div class="form-check form-switch ">
                                            <input class="form-check-input mt-4" type="checkbox" role="switch" id="toggle<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_status_id"] == 2) { ?> checked <?php } ?> />
                                            <label class="form-check-label text-success mt-4" for="toggle<?php echo $selected_data["id"]; ?>">

                                                <?php if ($selected_data["status_status_id"] == 1) { ?>
                                                    <h6>Your product is Active</h6>
                                                <?php } else { ?>
                                                    <h6 class="text-danger">Your product is Deactive</h6>
                                                <?php } ?>

                                            </label>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row g-1">
                                                    <div class="col-12 d-grid mt-3">
                                                        <button class="btn btn-secondary" onclick="sendid(<?php echo $selected_data['id']; ?>);">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?Php
                        }



                    ?>

                    <div class="row ">
                        <div class=" offset-lg-3 col-8 col-lg-6 text-center mb-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                        echo ("#");
                                                                    } else {
                                                                        echo "?page=" . ($pageno - 1);
                                                                    } ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                        if ($x == $pageno) {
                                    ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                        echo ("#");
                                                                    } else {
                                                                        echo "?page=" . ($pageno + 1);
                                                                    } ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?PHP include "footer.php"; ?>
    </div>
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