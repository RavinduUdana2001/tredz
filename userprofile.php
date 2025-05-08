<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Profile</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="resource/icon.ico" />
</head>

<body>
<?PHP include "header.php"; ?>
    <div class="container-fluid">
        <hr>
        <?PHP 

        if (isset($_SESSION["u"])) {

            $email = $_SESSION["u"]["email"];

            $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
            user.gender_gender_id=gender.gender_id WHERE `email`='" . $email . "'");

            $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

            $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                city.district_district_id=district.district_id INNER JOIN `province` ON 
                district.province_province_id=province.province_id WHERE `user_email`='" . $email . "'");


            $user_details = $details_rs->fetch_assoc();
            $image_details = $image_rs->fetch_assoc();
            $address_details = $address_rs->fetch_assoc();

        ?>








            <div class="col-12 text-center pb-3 pt-3 " style="background-color:  whitesmoke;">
                
                <h2 class="text-dark">User Profile</h2>
                
            </div>
            <div class="container">

                <div class="row">
                    <div class="col-11 col-lg-7 userprofilebox mt-5 mb-3">



                        <div class="col-12 mt-3  text-center">
                            <?php

                            if (empty($image_details["path"])) {
                            ?>
                                <img src="resource/user.png" class="rounded mt-5" style="width: 150px;" id="img" />
                            <?php
                            } else {
                            ?>
                                <img src="<?php echo $image_details["path"]; ?>" width="140px" height="140px" class="rounded-circle mt-5" id="img" />
                            <?php
                            }

                            ?>
                        </div>

                        <div class="col-12 mt-2 text-center">
                            <input type="file" class="d-none" id="profileimage" />
                            <label for="profileimage" class="btn btn-primary mt-5" onclick="changeProfileImg();">Update Profile Image</label>

                        </div>

                        <div class="col-12 mt-1 text-center">

                            <span><?php echo $user_details["name"]; ?></span>

                        </div>

                        <div class="col-12 mt-1 text-center">

                            <span class="text-secondary"><?PHP echo $email; ?></span>

                        </div>

                        <div class="row mt-4">

                            <div class="col-12 ">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" id="name" value="<?php echo $user_details["name"]; ?>" />
                            </div>



                            <div class="col-12 mt-2">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile" value="<?php echo $user_details["mobile"]; ?>" />
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="pw" value="<?php echo $user_details["password"]; ?>" readonly />
                                    <span class="input-group-text bg-primary">
                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" readonly value="<?php echo $user_details["email"]; ?>" />
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Registered Date</label>
                                <input type="text" class="form-control" readonly value="<?php echo $user_details["joined_date"]; ?>" />
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Address Line 01</label>
                                <?php
                                if (empty($address_details["line1"])) {
                                ?>
                                    <input id="line1" type="text" class="form-control" />
                                <?php
                                } else {
                                ?>
                                    <input id="line1" type="text" class="form-control" value="<?php echo $address_details["line1"]; ?>" />
                                <?php
                                }
                                ?>

                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Address Line 02</label>
                                <?php
                                if (empty($address_details["line2"])) {
                                ?>
                                    <input id="line2" type="text" class="form-control" />
                                <?php
                                } else {
                                ?>
                                    <input id="line2" type="text" class="form-control" value="<?php echo $address_details["line2"]; ?>" />
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            $province_rs = Database::search("SELECT * FROM `province`");
                            $district_rs = Database::search("SELECT * FROM `district`");
                            $city_rs = Database::search("SELECT * FROM `city`");
                            ?>

                            <div class="col-6 mt-2">
                                <label class="form-label">Province</label>
                                <select class="form-select" id="province">
                                    <option value="0">Select Province</option>
                                    <?php
                                    for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                        $province_data = $province_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                        if (!empty($address_details["province_id"])) {
                                                                                                            if ($province_data["province_id"] == $address_details["province_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>>
                                            <?php echo $province_data["province_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label">District</label>
                                <select class="form-select" id="district">
                                    <option value="0">Select District</option>
                                    <?php
                                    for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                        $district_data = $district_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                        if (!empty($address_details["district_id"])) {
                                                                                                            if ($district_data["district_id"] == $address_details["district_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>>
                                            <?php echo $district_data["district_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label">City</label>
                                <select class="form-select" id="city">
                                    <option value="0">Select City</option>
                                    <?php
                                    for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                        $city_data = $city_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                if (!empty($address_details["city_id"])) {
                                                                                                    if ($city_data["city_id"] == $address_details["city_id"]) {
                                                                                                ?>selected<?php
                                                                                                        }
                                                                                                    }
                                                                                                            ?>>
                                            <?php echo $city_data["city_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="col-6 mt-2">
                                <label class="form-label">Postal Code</label>
                                <?php
                                if (empty($address_details["postal_code"])) {
                                ?>
                                    <input id="pcode" type="text" class="form-control" />
                                <?php
                                } else {
                                ?>
                                    <input id="pcode" type="text" class="form-control" value="<?php echo $address_details["postal_code"]; ?>" />
                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" value="<?php echo $user_details["gender_name"]; ?>" readonly />
                            </div>

                            <div class="col-12 d-grid mt-2">
                                <button class="btn btn-primary" onclick="updateprofile();">Update My Profile</button>
                            </div>

                        </div>

                    </div>


                </div>

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
        <?PHP include "footer.php"; ?>
    </div>

    <script>
        function updateprofile() {


            var name = document.getElementById("name");
            var mobile = document.getElementById("mobile");
            var line1 = document.getElementById("line1");
            var line2 = document.getElementById("line2");
            var province = document.getElementById("province");
            var district = document.getElementById("district");
            var city = document.getElementById("city");
            var pcode = document.getElementById("pcode");
            var image = document.getElementById("profileimage");

            var form = new FormData();


            form.append("n", name.value);
            form.append("m", mobile.value);
            form.append("l1", line1.value);
            form.append("l2", line2.value);
            form.append("p", province.value);
            form.append("d", district.value);
            form.append("c", city.value);
            form.append("pc", pcode.value);
            form.append("i", image.files[0]);

            var request = new XMLHttpRequest();

            request.onreadystatechange = function() {
                if (request.status == 200 & request.readyState == 4) {
                    var response = request.responseText;

                    if (response == "Updated" || response == "Saved") {
                        window.location.reload();
                    } else if (response == "You have not selected any image.") {
                        alert("You have not selected any image.");
                        window.location.reload();
                    } else {
                        alert(response);
                    }

                }
            }

            request.open("POST", "updateProfileProcess.php", true);
            request.send(form);

        }
    </script>
</body>

</html>