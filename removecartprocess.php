<?PHP

include "connection.php";

$id = $_GET["id"];





Database::iud("DELETE FROM `cart` WHERE `product_id` = '".$id."'");

echo("success");



?>