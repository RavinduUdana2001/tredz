<?PHP

include "connection.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/icon.ico" />
</head>

<body class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center "></div>

    <div class="container-fluid">

        <div class="row d-flex align-items-center justify-content-center">

            <!--signup-->

            <div class="col-11 col-lg-5 box " id="signUpBox">


                <div class="col-12 col-lg-12 logo mt-1"></div>
                <hr>
                <div class="row col-12 text-center">
                    <div class="col-6 text-center">
                        <button class="btn btn-outline-primary" style="width: 150px;" type="button" onclick="upview1();">SignUp</button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn btn-outline-warning" style="width: 150px;" type="button" onclick="inview1();">SignIn</button>
                    </div>
                </div>

                <hr>
                <div class="row g-2 mt-3">
                    <div class="col-4 col-lg-4 ">
                        <div class="form-check">
                            <h4>SIGN UP</h4>
                        </div>
                    </div>
                    <div class="col-8 col-lg-8 text-end">
                        <div class="col-12 d-none" id="msgdiv">
                            <div class="alert alert-danger text-center" role="alert" id="msg">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">

                    <input type="text" class="form-control" placeholder="Company Name (Your brand name)" id="name" style="background-color: whitesmoke" />
                </div>

                <div class="col-12 mt-3">

                    <input type="email" class="form-control" placeholder="E-mail" id="email" style="background-color: whitesmoke" />
                </div>

                <div class="col-12 mt-3">

                    <input type="password" class="form-control" placeholder="Password" id="password" style="background-color: whitesmoke" />
                </div>

                <div class="col-12 mt-3">

                    <input type="text" class="form-control" placeholder="Mobile number" id="mobile" style="background-color: whitesmoke" />
                </div>
                <div class="col-12 form-floating mt-3 ">
                    <select class="form-select" id="gender" style="background-color: whitesmoke">
                        <?php

                        $rs = Database::search("SELECT * FROM `gender`");
                        $num = $rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {
                            $data = $rs->fetch_assoc();
                        ?>

                            <option value="<?php echo $data["gender_id"]; ?>">
                                <?php echo $data["gender_name"]; ?>
                            </option>

                        <?php
                        }

                        ?>
                    </select>
                    <label for="floatingSelectGrid">Gender</label>



                </div>

                <div class="col-12 col-lg-12 d-grid mt-3">
                    <button class="btn btn-primary" onclick="signup();">Sign Up</button>
                </div>

            </div>

            <!--signup-->

            <!--signin-->

            <div class="col-11 col-lg-5 box signin" id="signInBox">


                <div class="col-12 col-lg-12 logo mt-1"></div>
                <hr>
                <div class="row col-12 text-center">
                    <div class="col-6 text-center">
                        <button class="btn btn-outline-primary" style="width: 150px;" type="button" onclick="upview1();">SignUp</button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn btn-outline-warning" style="width: 150px;" type="button" onclick="inview1();">SignIn</button>
                    </div>
                </div>

                <hr>
                <div class="row g-2 mt-3">
                    <div class="col-4 col-lg-3 ">
                        <div class="form-check">
                            <h4>SIGN IN</h4>
                        </div>
                    </div>
                    <div class="col-8 col-lg-8 text-end">
                        <div class="col-12 d-none" id="msgdiv1">
                            <div class="alert alert-danger text-center" role="alert" id="msg1">

                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $email = "";
                $password = "";

                if (isset($_COOKIE["email"])) {
                    $email = $_COOKIE["email"];
                }

                if (isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                }
                ?>



                <div class="col-12 mt-4">

                    <input type="email" class="form-control" placeholder="E-mail" id="email1" style="background-color: whitesmoke" />
                </div>

                <div class="col-12 mt-3">

                    <input type="password" class="form-control" placeholder="Password" id="password1" style="background-color: whitesmoke; " />
                </div>
                <div class="row g-2 mt-3">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberme" />
                            <label class="form-check-label">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                    </div>
                </div>
                <div class="col-12 col-lg-12 d-grid mt-4">
                    <button class="btn btn-warning" onclick="signin();">Sign In</button>
                </div>

            </div>

            <!--signin-->
            <!-- modal -->
            <div class="modal" tabindex="-1" id="fpmodal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" />
                                        <button id="npb" class="btn btn-outline-secondary" type="button" onclick="showPassword1();">Show</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button id="rnpb" class="btn btn-outline-secondary" type="button" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vcode" />
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->


        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>