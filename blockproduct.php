<?PHP

include "connection.php";


$id = $_POST["i"];
$status = $_POST["s"];


if($status == 1){

    Database::iud("UPDATE `product` SET `status_status_id` = '2' WHERE `id` = '" . $id . "'");

echo ("success");

}else if($status == 2){

    Database::iud("UPDATE `product` SET `status_status_id` = '1' WHERE `id` = '" . $id . "'");

echo ("success");

}


