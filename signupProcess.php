<?PHP

include "connection.php";

$name = $_POST["n"];
$email = $_POST["e"];
$psw= $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];


if(empty($name)){
    echo ("Please Enter Your Name.");
}else if(strlen($name) > 20){
    echo ("Last Name Must Contain LOWER THAN 10 characters.");
}else if(empty($email)){
    echo ("Please Enter Your Email Address.");
}else if(strlen($email) > 100){
    echo ("Email Address Must Contain LOWER THAN 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email Address.");
}else if(empty($psw)){
    echo ("Please Enter Your Password.");
}else if(strlen($psw) < 5 || strlen($psw) > 20){
    echo ("Password Must Contain 5 to 20 Characters.");
}else if(empty($mobile)){
    echo ("Please Enter Your Mobile Number.");
}else if(strlen($mobile) != 10){
    echo ("Mobile Number Must Contain 10 characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/",$mobile)){
    echo ("Invalid Mobile Number.");
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' OR `mobile` = '".$mobile."'");
$n = $rs->num_rows;

if($n == 1){

    echo("Your email or mobile number is already used");
}else{
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");


    Database::iud("INSERT INTO `user`
    (`name`,`email`,`password`,`mobile`,`joined_date`,`status_status_id`,`gender_gender_id`) VALUES
    ('".$name."','".$email."','".$psw."','".$mobile."','".$date."','1','".$gender."')");
    
     echo ("success");

}


}
?>