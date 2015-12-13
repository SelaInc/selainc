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

require_once 'lib/swift_required.php';

// Create the Transport
//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl");
//    ->setUsername('sam.salisu@quiddi.com')
//    ->setPassword('Saminated241189');

//$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
//    ->setUsername('s.salisu@selainc.co.uk')
//    ->setPassword('Saminated4255');

$transport = Swift_SmtpTransport::newInstance('smtp-mail.live.com', 587, "tls")
    ->setUsername('s.salisu@live.co.uk')
    ->setPassword('saminated241189');



// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('SelaInc Contact Form')

// Set the From address with an associative array
    ->setFrom(array($email => $name))

// Set the To addresses with an associative array
    ->setTo(array('s.salisu@selainc.co.uk' =>'Hipster', 'bolajialade.work@gmail.com' => 'Hacker'))
    //  ->setTo(array('sam.salisu@quiddi.com' =>'Sam'))

// Give it a body
    ->setBody('Name: ' . $name . "\n"
        . 'Email: ' . $email . "\n"
        . 'Query: ' . $query . "\n"
        . 'phonenumber: ' . $phonenumber . "\n"
        . 'Message: ' . $info . "\n");


// And optionally an alternative body
//->addPart('<q>Here is the message itself</q>', 'text/html');

// Attachment
//$message->attach(
//    Swift_Attachment::fromPath($_FILES['fileatt']['tmp_name'])->setFilename($_FILES['fileatt']['name'])
//);

// Send the message
$result = $mailer->send($message);


if ($result)
{
    $data = array('success' => true, 'message' => 'Thanks! We have received your message. We will get back to you shortly');
    echo json_encode($data);
}
else
{
    $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error' . $mail->ErrorInfo);
    echo json_encode($data);
    exit;
}

//
//// Send reply back to confirm message received
//if($mailer->send($result)) {
//    $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
//    echo json_encode($data);
//    exit;
//}
//
//$data = array('success' => true, 'message' => 'Thanks! We have received your message. We will get back to you shortly');
//echo json_encode($data);


//if ($result) {
//    header('Location: http://www.quiddicompare.co.uk/index.html');
//}
//echo $result;
//