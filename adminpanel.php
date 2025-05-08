<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Admin panel</title>
    <link rel="icon" href="resource/icon.ico" />
</head>

<body>
    <?PHP include "adminheader.php";

    if (isset($_SESSION["au"])) {

    ?>
        <hr>


        <div class="container mt-5 mb-5" style="border: 1px solid black; border-radius: 10px; background-image: url(resource/background1.png); background-size: cover;">
            <div class="col-12 ps-5 pt-5 text-center">
                <div class="row mt-3">
                    <div class="col-12 col-lg-4">
                        <div class="card border-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header fs-4">Daily Earnings</div>

                            <?php

                            $today = date("Y-m-d");
                            $thismonth = date("m");
                            $thisyear = date("Y");

                            $a = "0";
                            $b = "0";
                            $c = "0";
                            $e = "0";
                            $f = "0";

                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                            $invoice_num = $invoice_rs->num_rows;

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();

                                $f = $f + $invoice_data["qty"];

                                $d = $invoice_data["date"];
                                $splitDate = explode(" ", $d);
                                $pdate = $splitDate["0"];

                                if ($pdate == $today) {
                                    $a = $a + $invoice_data["total"];
                                    $c = $c + $invoice_data["qty"];
                                }

                                $splitMonth = explode("-", $pdate);
                                $pyear = $splitMonth["0"];
                                $pmonth = $splitMonth["1"];

                                if ($pyear == $thisyear) {
                                    if ($pmonth == $thismonth) {
                                        $b = $b + $invoice_data["total"];
                                        $e = $e + $invoice_data["qty"];
                                    }
                                }
                            }

                            ?>

                            <div class="card-body text-primary">
                                <h4 class="card-title">Rs.<?PHP echo $a; ?>.00</h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card border-secondary mb-3" style="max-width: 18rem;">
                            <div class="card-header fs-4">Monthly Earnings</div>
                            <div class="card-body text-secondary">
                                <h4 class="card-title">Rs.<?PHP echo $b; ?>.00</h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card border-success mb-3" style="max-width: 18rem;">
                            <div class="card-header fs-4">Today Sellings</div>
                            <div class="card-body text-success">
                                <h4 class="card-title"><?PHP echo $c; ?> items</h4>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-12 ps-5 text-center pb-5">
                <div class="row">

                    <div class="col-12 col-lg-4">
                        <div class="card border-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header fs-4">Monthly Sellings</div>
                            <div class="card-body text-danger">
                                <h4 class="card-title"><?PHP echo $e; ?> items</h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card border-warning mb-3" style="max-width: 18rem;">
                            <div class="card-header fs-4">Total Sellings</div>
                            <div class="card-body">
                                <h4 class="card-title"><?PHP echo $f; ?> items</h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card border-info mb-3" style="max-width: 18rem;">
                            <div class="card-header fs-4">Total Engagements</div>
                            <div class="card-body">
                                <?php
                                $user_rs = Database::search("SELECT * FROM `user`");
                                $user_num = $user_rs->num_rows;
                                ?>
                                <h4 class="card-title"><?PHP echo $user_num; ?> members</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <?PHP include "footer.php"; ?>
    <?PHP
    } else {

    ?>

        <script>
            window.location = "adminlogin.php";
        </script>
    <?PHP


    }







    ?>
</body>

</html>