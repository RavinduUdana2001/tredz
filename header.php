<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/icon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body >



    <div class="row col-12 mx-auto mt-4">
        <div class="col-12 col-lg-7 mt-1 mt-lg-0 mb-1 mb-lg-0">

            <?PHP
            session_start();

            if (isset($_SESSION["u"])) {
                $data = $_SESSION["u"];
            ?>
                <button class="btn" style="background-color: #ffb3b3;" onclick="signout();"><b>Hi </b><?PHP echo $data["name"]; ?> | Signout</button>

            <?PHP
            } else {
            ?>
                <a href="index.php"> <button class="btn btn-outline-secondary" style="background-color: white; color:blue;">Sign In or Register</button></a>

            <?PHP
            }



            ?>
            <hr class="d-lg-none d-block mt-3">
        </div>
        <!--<div class="col-2 col-lg-1 text-lg-end mb-3 mb-lg-0 ms-lg-5">
                <button class="btn btn-outline-dark">Sell</button>
            </div>-->

        <div class="col-6 col-lg-2 dropdown  text-start text-lg-end offset-lg-1">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style=" border:1px solid black;">
                Trendz Fashion
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="home.php">Dashboard</a></li>
                <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                             
                <li><a class="dropdown-item" href="myproduct.php">My Products</a></li>
                <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
               
            </ul>
        </div>



        <?PHP
        include "connection.php";
        if (isset($_SESSION["u"])) {


            $ms_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
            $ms_num = $ms_rs->num_rows;
        }
        ?>




        <div class="col-3 col-lg-1 text-end text-lg-end ">
            <button type="button" class="btn position-relative" style="border: 1px solid black; border-radius: 50%;" onclick="window.location = 'watchlist.php';">
                <i class="bi bi-heart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?PHP

                    if (isset($ms_num)) {

                        echo $ms_num;
                    } else {

                    ?>0<?PHP
                    }


                        ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </div>



        <?PHP

        if (isset($_SESSION["u"])) {

            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "'");
            $cart_num = $cart_rs->num_rows;
        }


        ?>




        <div class="col-3 col-lg-1 text-lg-end  text-end  " onclick="window.location = 'cart.php'">

            <button type="button" class="btn position-relative" onclick="window.location = 'messages.php';" style="border: 1px solid black; border-radius: 50%;">
                <i class="bi bi-cart4"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">


                    <?PHP
                    if (isset($_SESSION["u"])) {



                        echo ($cart_num);
                    } else {
                    ?>0<?PHP
                    }

                        ?>


                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
        </div>

    </div>

    </div>




    <script src="bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>