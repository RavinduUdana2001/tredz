<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Admin login</title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/icon.ico" />
</head>

<body style="background-image:url('resource/background1.png'); background-size: cover;">

    <div class="col-12 col-lg-4 box1" id="login1">

        <div class="col-12 mt-3 text-center">
            <img src="resource/logo.png" alt="trendz" width="150px" />
        </div>
        <div class="col-12 text-center">
            <hr>
            <h3>Admin Login</h3>
            <hr>
        </div>
        <div class="col-10 mx-auto">
            <input type="email" class="form-control" placeholder="Enter your email..." style="border-radius: 10px;" id="email" />
        </div>

        <div class="col-10 mx-auto d-grid mt-5">
            <button class="btn btn-primary" style="border-radius: 10px;" onclick="adminverification();">Send verification code</button>
        </div>

    </div>


    <div class="col-12 col-lg-4 box1" id="login2" style="visibility: hidden;">

        <div class="col-12 mt-3 text-center">
            <img src="resource/logo.png" alt="trendz" width="150px" />
        </div>
        <div class="col-12 text-center">
            <hr>
            <h3>Admin Login</h3>
            <hr>
        </div>
        <div class="col-10 mx-auto">
            <input type="text" class="form-control" placeholder="Enter Verification code" style="border-radius: 10px;" id="code"/>
        </div>

        <div class="col-10 mx-auto d-grid mt-5">
            <button class="btn btn-primary" style="border-radius: 10px;" onclick="adminlogin();">Login</button>
        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>