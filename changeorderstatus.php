<?PHP

include "connection.php";


$_id = $_POST["i"];
$_status = $_POST["s"];

if($_status == 0){

    Database::iud("UPDATE `invoice` SET `status` = '1' WHERE `invoice_id` = '".$_id."'");
    echo("success");

}else if($_status == 1){
    Database::iud("UPDATE `invoice` SET `status` = '2' WHERE `invoice_id` = '".$_id."'");
    echo("success");
}


?>