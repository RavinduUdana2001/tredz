<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Manage users</title>
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
                        <th scope="col">Profile Image</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Joined Date</th>
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

                    $query = "SELECT * FROM `user`";

                    $user_rs = Database::search($query);

                    $user_num = $user_rs->num_rows;

                    $results_per_page = 10;
                    $number_of_pages = ceil($user_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;


                    for ($x = 0; $x < $selected_num; $x++) {

                        $selected_data = $selected_rs->fetch_assoc();
                        $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $selected_data["email"] . "'");

                        $img_data = $img_rs->fetch_assoc();
                    ?>
                        <tr>
                            <td><?PHP echo $x + 1; ?></td>
                            <?PHP
                            if (isset($img_data["path"])) {
                            ?><td><img src="<?PHP echo $img_data["path"]; ?>" class="rounded-circle" alt="user" width="45px" /></td><?PHP
                                                                                                                                } else {

                                                                                                                                    ?><td><img src="resource/user.png" class="rounded-circle" alt="user" width="45px" /></td><?PHP
                                                                                                                                                                                                                            }


                                                                                                                                                                                                                                ?>

                            <td><?PHP echo $selected_data["name"]; ?></td>
                            <td><?PHP echo $selected_data["email"]; ?></td>
                            <td><?PHP echo $selected_data["mobile"]; ?></td>
                            <td><?PHP echo $selected_data["joined_date"]; ?></td>

                            <?PHP
                            
                            if($selected_data["status_status_id"] == 1){

                                ?><td><button class="btn btn-danger" onclick="blockuser('<?PHP echo $selected_data['email'];?>','<?PHP echo $selected_data['status_status_id'];?>');">Block</button></td><?PHP

                            }else if($selected_data["status_status_id"] == 2){

                                ?><td><button class="btn btn-success" onclick="blockuser('<?PHP echo $selected_data['email'];?>','<?PHP echo $selected_data['status_status_id'];?>');">Unblock</button></td><?PHP

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