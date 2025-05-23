<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Messages</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/icon.ico" />
</head>

<body style="background-image: url(resource/background1.png); background-size: cover;">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            if (isset($_SESSION["u"])) {

            ?><?PHP


            } else {
                ?>

            <script>
                window.location = "index.php";
            </script>

        <?PHP
            }

            $mail = $_SESSION["u"]["email"];
        ?>

        <div class="col-12">
            <hr />
        </div>

        <div class="col-12 py-2 px-4">
            <div class="row overflow-hidden shadow rounded">
                <div class="col-12 col-lg-5 px-0">
                    <div class="">
                        <div class="px-4 py-2" style="background-color:transparent; border: 1px solid black; border-radius: 10px;">


                            <hr>

                            <div class="col-12">

                                <?php

                                $msg_rs = Database::search("SELECT DISTINCT * FROM `chat` WHERE `to`='" . $mail . "' ORDER BY `date_time` DESC");
                                $msg_num = $msg_rs->num_rows;

                                ?>

                                <!--  -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Received</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sent</button>
                                    </li>
                                </ul>




                                <div class="tab-content" id="myTabContent">


                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="height: 532px;">

                                        <?PHP

                                        if ($msg_num == 0) {

                                        ?>

                                            <div class="col-12 text-center">
                                                <img src="resource/message1 (2).gif" alt="messages" width="400px" />
                                                <div class="btn btn-secondary">No messages yet</div>
                                            </div>


                                        <?PHP


                                        } else {
                                        ?>

                                            <div class="message_box" id="message_box">

                                                <?php

                                                for ($x = 0; $x < $msg_num; $x++) {
                                                    $msg_data = $msg_rs->fetch_assoc();

                                                    $sender = $msg_data["from"];

                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $sender . "'");

                                                    $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $sender . "'");

                                                    $user_data = $user_rs->fetch_assoc();
                                                    $img_data = $img_rs->fetch_assoc();

                                                    if ($msg_data["status"] == 0) {
                                                ?>
                                                        <div class="list-group rounded-0" onclick="viewMessage('<?php echo $sender; ?>');">
                                                            <a href="#" class="list-group-item list-group-item-action text-white rounded-0 " style="background-color: #4da6ff; border-radius: 20px;">

                                                                <div class="media">

                                                                    <?php
                                                                    if (isset($img_data["path"])) {
                                                                    ?>
                                                                        <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img src="resource/user.png" width="50px" class="rounded-circle">
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold"><?php echo $user_data["name"]; ?></h6>
                                                                            <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                                        </div>
                                                                        <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="list-group rounded-0" onclick="viewMessage('<?php echo $sender; ?>');">
                                                            <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 bg-body">

                                                                <div class="media">

                                                                    <?php
                                                                    if (isset($img_data["path"])) {
                                                                    ?>
                                                                        <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img src="resource/user.png" width="50px" class="rounded-circle">
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold"><?php echo $user_data["name"]; ?></h6>
                                                                            <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                                        </div>
                                                                        <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                        </div>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </div>

                                        <?PHP
                                        }




                                        ?>


                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                        <div class="message_box" id="message_box">

                                            <?php

                                            $msg_rs2 = Database::search("SELECT DISTINCT * FROM `chat` WHERE `from`='" . $mail . "' ORDER BY `date_time` DESC");
                                            $msg_num2 = $msg_rs2->num_rows;

                                            for ($y = 0; $y < $msg_num2; $y++) {
                                                $msg_data2 = $msg_rs2->fetch_assoc();

                                                $receiver = $msg_data2["to"];

                                                $user_rs2 = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON 
                                                user.email=profile_img.user_email WHERE `email`='" . $receiver . "'");

                                                $user_data2 = $user_rs2->fetch_assoc();

                                            ?>




                                                <div class="list-group rounded-0" onclick="viewMessage('<?php echo $receiver; ?>');">
                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-0" style="background-color: #ccccb3;">
                                                        <div class="media">

                                                            <?php
                                                            if (isset($user_data2["path"])) {
                                                            ?>
                                                                <img src="<?php echo $user_data2["path"]; ?>" width="50px" class="rounded-circle">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resource//user.png" width="50px" class="rounded-circle">
                                                            <?php
                                                            }
                                                            ?>

                                                            <div class="me-4">
                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                    <h6 class="mb-0 fw-bold"> <?PHP echo $user_data2["name"]; ?></h6>
                                                                    <small class="small fw-bold"><?php echo $msg_data2["date_time"]; ?></small>

                                                                </div>
                                                                <p class="mb-0"><?php echo $msg_data2["content"]; ?></p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </div>

                                            <?php
                                            }

                                            ?>

                                        </div>

                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7 px-0">
                    <div class="row px-4 py-5 text-white chat_box" id="chat_box">

                        <!-- view area -->


                    </div>
                    <!-- txt -->
                    <div class="col-12 px-3">
                        <div class="col-12 col-lg-5 mb-1">
                            <select class="form-select" id="select_user">
                                <option value="0">Select Receiver</option>
                                <?php
                                $select_rs = Database::search("SELECT * FROM `user`");
                                $select_num = $select_rs->num_rows;
                                for ($z = 0; $z < $select_num; $z++) {
                                    $selected_data = $select_rs->fetch_assoc();
                                    if ($selected_data["email"] != $mail) {
                                ?>
                                        <option value="<?php echo $selected_data["email"]; ?>">
                                            <?php echo $selected_data["name"]; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="input-group">
                                <input type="text" class="form-control rounded  py-1 bg-light border-dark" placeholder="Type a message ..." aria-describedby="send_btn" id="msg_txt" />
                                <button class="btn btn-primary fs-2" id="send_btn" onclick="send_msg();"><i class="bi bi-send-fill fs-1"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- txt -->
                </div>

            </div>
        </div>

        <?php include "footer.php"; ?>
        </div>
    </div>





    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>