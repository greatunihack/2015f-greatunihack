<?php
if(!session_id()) {
  session_start();
}
try
{
  if(isset($_SESSION['has_sent']) && strtotime($_SESSION['has_sent']) + 60 > strtotime("now")) {    
    throw new Exception("You have already sent a message. Try again after a minute.", 1);
  }
  if(!isset($_POST['name'], $_POST['email'], $_POST['message']) 
    || !$_POST['name'] || !$_POST['email'] || !$_POST['message']) {
    throw new Exception("Error. Invalid input.", 1);
  }
  $email = trim($_POST['email']);
  $name = ucwords(htmlentities(trim($_POST['name'])));
  $msg = ucfirst(htmlentities(trim($_POST['message'])));
  $date = date('d-m-Y H:i:s');
  $to = "contact@greatunihack.com";
  $subject = "[2016s]Contact query";
  $headers = "From: " . $name . " < " . strip_tags($email) . " >\r\n";
  $headers .= "Reply-To: " . $name . " < " . strip_tags($email) . " >\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
  $headers .= "X-Priority: 2\r\n";
  $message = 
  "
  <!DOCTYPE html>
  <html>
  <head>
    <title>$subject</title>
  </head>
  <body>
    You have a new message from $name:
    <br>
    $msg
    <br>
    Date: $date
  </body>
  </html>
  ";
  if(!mail($to, $subject, $message, $headers)) {
    throw new Exception("Error sending email. Please try again or contact the administrator.", 1);
  }
  $_SESSION['has_sent'] = $date;
  echo json_encode(["success"]);
  exit();
}
catch (Exception $e) {
  echo json_encode(["error", $e->getMessage()]);
  exit();
}
?>