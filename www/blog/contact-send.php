<?php
/**
 * Created by IntelliJ IDEA.
 * User: simba
 * Date: 25/11/2014
 * Time: 01:32
 */

$_SESSION["post"] = $_POST;
$query = $_POST["query"];
$name = $_POST["name"];
$email = $_POST["email"];
$phonenumber = $_POST["phonenumber"];
$info = $_POST["message"];

//require_once 'lib/swift_required.php';

// Create the Transport
//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, "ssl")
//    ->setUsername('sam.salisu@quiddi.com')
//    ->setPassword('Saminated241189');

//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
//    ->setUsername('s.salisu@selainc.co.uk')
//    ->setPassword('Saminated4255');

//$transport = Swift_SmtpTransport::newInstance('smtp-mail.live.com', 587, "tls")
//    ->setUsername('s.salisu@live.co.uk')
//    ->setPassword('saminated241189');


// Create the Mailer using your created Transport
//$mailer = Swift_Mailer::newInstance($transport);

// Create a message
//$message = Swift_Message::newInstance('SelaInc Contact Form')
//
//// Set the From address with an associative array
//    ->setFrom(array($email => $name))
//
//// Set the To addresses with an associative array
//    ->setTo(array('s.salisu@selainc.co.uk' =>'Hipster', 'bolajialade.work@gmail.com' => 'Hacker'))
//    //  ->setTo(array('sam.salisu@quiddi.com' =>'Sam'))
//
//// Give it a body
//    ->setBody('Name: ' . $name . "\n"
//        . 'Email: ' . $email . "\n"
//        . 'Query: ' . $query . "\n"
//        . 'phonenumber: ' . $phonenumber . "\n"
//        . 'Message: ' . $info . "\n");
//
//
//
//// Send the message
//$result = $mailer->send($message);
//
//
//if ($result)
//{
//    $data = array('success' => true, 'message' => 'Thanks! We have received your message. We will get back to you shortly');
//    echo json_encode($data);
//}
//else
//{
//    $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error' . $mail->ErrorInfo);
//    echo json_encode($data);
//    exit;
//}

//Send mail using gmail

require_once('PHPMailer/PHPMailerAutoload.php');

$mail = new PHPMailer(true);

//if($send_using_gmail){
//    $mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPDebug = 1;
$mail->SMTPAuth = false; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the server
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "sam.salisu@quiddi.com"; // GMAIL username
$mail->Password = "Saminated4255"; // GMAIL password
//}

//Typical mail data
//$email = 's.salisu@live.co.uk, gbolahanalade@gmail.com, yaqub_umaru@yahoo.co.uk';
//$sendmail = "$email";

$recipients = array(
    's.salisu@live.co.uk' => 'Saminu',
    'gbolahanalade@gmail.com' => 'Bolaji',
    'yaqub_umaru@yahoo.co.uk' => 'Umaru',
    // ..
);


$email_from = 'info@selainc.co.uk';
$name_from = 'Selainc.co.uk';

//$mail->AddAddress($sendmail, $name);

foreach ($recipients as $email2 => $name2) {
    $mail->AddCC($email2, $name2);
}

$mail->SetFrom($email_from, $name_from);
$mail->Subject = $query;
$mail->Body = ('Name: ' . $name . "\n"
    . 'Email: ' . $email . "\n"
    . 'Query: ' . $query . "\n"
    . 'phonenumber: ' . $phonenumber . "\n"
    . 'Message: ' . $info . "\n");

try {
    $mail->Send();
    $data = array('success' => true, 'message' => 'Thanks! We have received your message. We will get back to you shortly');
    echo json_encode($data);

} catch (Exception $e) {
//    //Something went bad
//    echo "Fail - " . $mail->ErrorInfo;
    $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error' . $mail->ErrorInfo);
    echo json_encode($data);
    exit;
}