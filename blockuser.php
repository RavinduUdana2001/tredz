<?PHP

include "connection.php";


$email = $_POST["e"];
$status = $_POST["s"];


if($status == 1){

    Database::iud("UPDATE `user` SET `status_status_id` = '2' WHERE `email` = '" . $email . "'");

echo ("success");

}else if($status == 2){

    Database::iud("UPDATE `user` SET `status_status_id` = '1' WHERE `email` = '" . $email . "'");

echo ("success");

}


