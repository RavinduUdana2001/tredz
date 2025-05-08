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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<div class="bg-white pb-3 pt-1">

    <?PHP include "header.php"; ?>
</div>

<body class="main-body1">

    <div class="row ms-lg-1 mt-2 mb-3">
        <div class="col-12 col-lg-5" style="background-color: transparent; backdrop-filter: blur(1px); border: 1px solid black; border-radius:10px; height: 530px;">

            <div class="col-12 overflow-scroll" style="height: 510px">


                <div class="col-12 text-center"><i class="bi bi-chat-heart-fill" style="font-size: 2rem;"></i><img src="resource/logo.png" alt="logo" width="170px" /></div>
                <div class="bg-dark">
                    <hr>
                </div>

                <?PHP



                $chat_rs = Database::search("SELECT * FROM `chat` WHERE `to` = '" . $_SESSION["u"]["email"] . "'
                 ORDER BY `date_time` DESC ");

                $chat_num = $chat_rs->num_rows;

                if ($chat_num > 0) {


                    for ($x = 0; $x < $chat_num; $x++) {

                        $chat_data = $chat_rs->fetch_assoc();
    
                        if ($chat_data["status"] == 0) {
    
                    ?>
    
                            <div class="col-11 pt-1 pb-1 ms-3 mt-2 mb-2 " style="background: radial-gradient(circle, #d966ff, #4da6ff , whitesmoke); border-radius: 10px; border: 1px solid black;">
                                <div class="row">
                                    <div class="col-2 ms-1">
                                        <img src="resource/user.png" width="60px" height="60px" alt="message" class="rounded-circle" />
                                    </div>

                                    
                                    <div class="col-8 mt-2 text-center">
    
                                        <h4>Kavindu singhapura</h4>
    
                                    </div>
                                    
                                </div>
                                <div class="col-11 text-end">
                                 <span class="badge bg-dark">2023:12:24 12:23:45</span>

                                </div>
                            </div>
    
    
                        <?PHP
    
    
    
                        } else {
    
                        ?>
                            <div class="col-11 pt-1 pb-1 ms-3 mt-2 mb-2" style="background-color: whitesmoke; border-radius: 10px; border: 1px solid black;">
                                <div class="row">
                                    <div class="col-2 ms-1">
                                        <img src="resource/user.png" width="60px" height="60px" alt="message" class="rounded-circle" />
                                    </div>
                                    <div class="col-8 mt-2 text-center">
    
                                        <h4>Kavindu singhapura</h4>
    
                                    </div>
    
                                </div>
                                <div class="col-11 text-end">
                                 <span class="badge bg-dark">2023:12:24 12:23:45</span>

                                </div>
                            </div>
                    <?PHP
    
                        }
                    }
    
                    
    
                }else{

                    ?>
                    
                    <div class="col-12 text-center">
                    <img src="resource/message1 (2).gif" width="450px" alt="empty" />
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-secondary">Not messages yet...</button>
                </div>

                    <?PHP
                }


               ?>






               
            </div>


        </div>

        <div class="col-12 col-lg-7" style="  border-radius:20px; height: 470px;">

            <div class="col-12 overflow-scroll" style="height: 460px">

            </div>

            <div class="row mt-4">
                <div class="col-10 d-grid">
                    <input type="text" class="form-control" placeholder="Enter your message..." style="border: 1px solid black;" />
                </div>
                <div class="col-2 d-grid">
                    <button class="btn btn-primary" style="border: 1px solid black;"><i class="bi bi-send-check"></i></button>
                </div>
            </div>
        </div>
    </div>
    <?PHP include "footer.php"; ?>
    <script src="script.js"></script>

</body>

</html>