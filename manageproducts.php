<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | manage Products</title>
    <link rel="icon" href="resource/icon.ico" />
</head>

<body>
    <?PHP include "adminheader.php";

    if (isset($_SESSION["au"])) {

    ?>


        <hr>

        <div class="container-fluid mt-3">
            <table class="table text-center">
                <thead>

                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quentity</th>
                        <th scope="col">Registered Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?PHP


                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $query = "SELECT * FROM `product`";

                    $product_rs = Database::search($query);

                    $product_num = $product_rs->num_rows;

                    $results_per_page = 10;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;


                    for ($x = 0; $x < $selected_num; $x++) {

                        $selected_data = $selected_rs->fetch_assoc();
                        $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id` = '" . $selected_data["id"] . "'");

                        $img_data = $img_rs->fetch_assoc();

                    ?>

                        <tr>
                            <td><?PHP echo $x + 1; ?></td>
                            <?PHP
                            if (isset($img_data["img_path"])) {
                            ?><td><img src="<?PHP echo $img_data["img_path"]; ?>" class="rounded-circle" alt="user" width="45px" /></td><?PHP
                                                                                                                                    } else {

                                                                                                                                        ?><td><img src="resource/user.png" class="rounded-circle" alt="user" width="45px" /></td><?PHP
                                                                                                                                                                                                                            }


                                                                                                                                                                                                                                ?>

                            <td><?PHP echo $selected_data["title"]; ?></td>
                            <td><?PHP echo $selected_data["price"]; ?></td>
                            <td><?PHP echo $selected_data["qty"]; ?> items</td>
                            <td><?PHP echo $selected_data["datetime_added"]; ?></td>
                            <?PHP

                            if ($selected_data["status_status_id"] == 1) {

                            ?><td><button class="btn btn-danger" onclick="blockproduct('<?PHP echo $selected_data['id'];?>','<?PHP echo $selected_data['status_status_id'];?>');">Block</button></td><?PHP

                                                                                    } else if ($selected_data["status_status_id"] == 2) {

                                                                                        ?><td><button class="btn btn-success" onclick="blockproduct('<?PHP echo $selected_data['id'];?>','<?PHP echo $selected_data['status_status_id'];?>');">Unblock</button></td><?PHP

                                                                                        }



                                                                                            ?>
                        </tr>


                    <?PHP



                    }
                    ?>




                </tbody>
            </table>
        </div>



        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="
                            <?php if ($pageno <= 1) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno - 1);
                            } ?>
                            " aria-label="Previous">
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
                        <a class="page-link" href="
                            <?php if ($pageno >= $number_of_pages) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno + 1);
                            } ?>
                            " aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    <?PHP
    } else {

    ?>

        <script>
            window.location = "adminlogin.php";
        </script>
    <?PHP


    }







    ?>
    <?PHP include "footer.php";?>
</body>

</html>