<?PHP

include "connection.php";

$id = $_GET["id"];





Database::iud("DELETE FROM `watchlist` WHERE `product_id` = '".$id."'");

echo("success");



?>