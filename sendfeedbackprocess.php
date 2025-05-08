<?PHP
session_start();

include "connection.php";

if (isset($_SESSION["u"])) {

    $id = $_POST["pid"];
    $type = $_POST["type"];
    $con = $_POST["con"];
    $mail = $_SESSION["u"]["email"];


    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`type`,`date`,`feed`,`product_id`,`user_email`) VALUES 
    ('".$type."','".$date."','".$con."','".$id."','".$mail."')");

    echo ("success");
}
