<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3 mb-4">
            <div class="col-12 col-lg-3 text-center">
                <img src="resource/logo.png" alt="logo" width="180px" />
            </div>
            <div class="col-12 col-lg-6 dropdown  text-center text-lg-end mt-2">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style=" border:1px solid black;">
                    Trendz Admin Panel
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="adminpanel.php">Admin Home</a></li>
                    <li><a class="dropdown-item" href="manageusers.php">Manage Users</a></li>
                    <li><a class="dropdown-item" href="manageproducts.php">Manage Products</a></li>
                    <li><a class="dropdown-item" href="trackorder.php">Track Orders</a></li>
                    
                </ul>
            </div>
           <?PHP include "connection.php";?>
            <div class="col-12 col-lg-3 text-center mt-2">
            <?PHP
            session_start();


            if(isset($_SESSION["au"])){

                ?>
                
                
                <button class="btn btn-dark" onclick="adminsignout();">
                   <b>Hi</b> <?PHP echo $_SESSION["au"]["lname"];?> | Signout
                </button>
                
                <?PHP
            }else{

                ?>
                
                
                <button class="btn btn-danger">
                   <b>Warning</b>
                </button>

                <?PHP
            }
            
            
            
            ?>
            </div>
        </div>
       
    </div>

    <script src="bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>