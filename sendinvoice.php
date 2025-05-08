<?PHP
session_start();

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["msg"])){

    $msg = $_POST["msg"];

    $email = $_SESSION["u"]["email"];

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ksinghapura@gmail.com';
    $mail->Password = 'byisjjkjgdljmaos';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('ksinghapura@gmail.com', 'Trendz Invoice');
    $mail->addReplyTo('ksinghapura@gmail.com', 'Trendz Invoice');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Trendz Invoice';
    $bodyContent = $msg;
    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo 'Email sending failed.';
    } else {
        echo 'Success';
    }
    


}else{
    echo("no invoice");
}


?>