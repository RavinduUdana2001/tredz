<?PHP
session_start();

include "connection.php";

$user = $_SESSION["u"]["email"];

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];

$query = "SELECT * FROM `product` WHERE `user_email` = '" . $user . "'";

if (!empty($search)) {

    $query .= " AND `title` LIKE '%" . $search . "%'";
}

if ($time != "0") {
    if ($time == "1") {
        $query .= " ORDER BY `datetime_added` DESC";
    } else if ($time == "2") {
        $query .= " ORDER BY `datetime_added` ASC";
    }
}

if ($time != "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " , `qty` DESC";
    } else if ($qty == "2") {
        $query .= " , `qty` ASC";
    }
} else if ($time == "0" && $qty != "0") {
    if ($qty == "1") {
        $query .= " ORDER BY `qty` DESC";
    } else if ($qty == "2") {
        $query .= " ORDER BY `qty` ASC";
    }
}


?>





<div class="row justify-content-center">

    <?PHP

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $product_rs = Database::search($query);
    $product_num = $product_rs->num_rows;

    $results_per_page = 2;
    $number_of_pages = ceil($product_num / $results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;
    $selected_rs = Database::search($query." LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

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
                                        <button class="btn btn-secondary">
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

    <div class="row justify-content-center">
        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
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