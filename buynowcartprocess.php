<?PHP

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    $price = $_GET["id"];

    $umail = $_SESSION["u"]["email"];


    $array;

    $order_id = uniqid();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_city_id"];
        $address = $city_data["line1"] . ", " . $city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();

        $item = "Cart Payment";
        $amount = $price;

        $name = $_SESSION["u"]["name"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["city_name"];

        $merchant_id = "1224972";
        $merchant_secret = "NTk3MDk2MDcwMjYzNDgxODA0MTg5NTI5NjQ0NTE2MTc4NjYwOTI=";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["name"] = $name;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["umail"] = $umail;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);






    } else {
        echo ("2");
    }
} else {

    echo ("1");
}
