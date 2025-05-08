<?PHP

include "connection.php";

$id = $_GET["id"];





Database::iud("DELETE FROM `invoice` WHERE `order_id` = '".$id."'");

echo("success");



?>