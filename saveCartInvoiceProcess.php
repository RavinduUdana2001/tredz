<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    $order_id = $_POST["o"];

    $mail = $_POST["m"];



    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $mail . "'");
    $cart_num = $cart_rs->num_rows;


    for ($x = 0; $x < $cart_num; $x++) {


        $cart_data = $cart_rs->fetch_assoc();



        $pid = $cart_data["product_id"];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();

        $amount = $product_data["price"];

        $qty = $cart_data["qty"];

        $current_qty = $product_data["qty"];
        $new_qty = $current_qty - $qty;

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");


        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`user_email`) 
    VALUES ('" . $order_id . "','" . $date . "','" . $amount . "','" . $qty . "','0','" . $pid . "','" . $mail . "')");

        echo ("success");
    }
}
