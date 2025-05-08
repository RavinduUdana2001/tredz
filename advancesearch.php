<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trendz | Advanced search</title>
    <link rel="stylesheet" href="bootstrap.bundle.min.js" />
</head>

<body>
    <?PHP include "header.php"; ?>
    <div class="container-fluid">
        <hr>
        <div class="col-12 text-center pb-3 pt-3 " style="background-color:  whitesmoke;">

            <h2 class="text-dark">Advanced search</h2>

        </div>
    </div>

    <div class="container">



        <div class="col-12 col-lg-10 mx-auto mt-3" style="height: 17vh; box-shadow: 0 0 8px 0px rgba(0,0,0,0.2);">


            <div class="row col-11 col-lg-12 mx-auto">
                <div class="col-12 col-lg-6 text-center mt-3">
                    <img src="resource/logo.png" alt="logo" width="170px" />
                </div>
                <div class="col-1 mt-3 d-none d-lg-block" style="border-left: 1px solid grey;height: 70px;"></div>
                <div class="col-12 col-lg-3 mt-4 mx-auto">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>SORT BY</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-10 mx-auto mt-3" style="height: 60vh; box-shadow: 0 0 8px 0px rgba(0,0,0,0.2);">

            <div class="row col-lg-11 mx-auto justify-content-center">
                <div class="col-11 col-lg-4 mt-5">
                    <select class="form-select" aria-label="Default select example">
                        <option value="0">Select Category</option>



                        <?PHP

                        
                        $cat_rs = Database::search("SELECT * FROM `category`");
                        $num = $cat_rs->num_rows;

                        for ($x = 0; $x < $num; $x++) {

                            $cat_data = $cat_rs->fetch_assoc();
                        ?>
                            <option value="<?PHP echo $cat_data["cat_id"]; ?>"><?PHP echo $cat_data["cat_name"]; ?></option>
                        <?PHP
                        }



                        ?>
                    </select>
                </div>

                <div class="col-11 col-lg-4 mt-5">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Brand</option>
                        <?PHP

                    
                        $brand_rs = Database::search("SELECT * FROM `brand`");
                        $brand_num = $brand_rs->num_rows;

                        for ($x = 0; $x < $brand_num; $x++) {

                            $brand_data = $brand_rs->fetch_assoc();
                        ?>
                            <option value="<?PHP echo $brand_data["brand_id"]; ?>"><?PHP echo $brand_data["brand_name"]; ?></option>
                        <?PHP
                        }



                        ?>
                    </select>
                </div>

                <div class="col-11 col-lg-4 mt-5">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Model</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div class="row col-lg-11 mx-auto mt-4 justify-content-center">
                <div class="col-11 col-lg-6">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Size</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-11 col-lg-6 mt-2 mt-lg-0">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Select Colour</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>

            <div class="row col-lg-11 mx-auto mt-4 justify-content-center">
                <div class="col-11 col-lg-6 ">

                    <input type="text" class="form-control" placeholder="Price from">

                </div>
                <div class="col-11 col-lg-6 mt-2 mt-lg-0">

                    <input type="text" class="form-control" placeholder="Price to">

                </div>
            </div>

            <div class="row col-11 mx-auto mt-4">
                <div class="col-9 col-lg-10">
                    <input type="text" class="form-control" placeholder="Search here...">
                </div>
                <div class="col-2 d-grid">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>




        </div>
        
    </div>
    <div class="container-fluid mt-5">
    <?PHP include "footer.php";?>
    </div>




    <script src=""></script>
</body>

</html>