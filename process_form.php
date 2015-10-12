<?php
try
{
  if(!isset($_POST['name'], $_POST['email'], $_POST['message']) 
    || !$_POST['name'] || !$_POST['email'] || !$_POST['message']) {
    throw new Exception("Error. Invalid input.", 1);
  }

  $email = trim($_POST['email']);
  $name = ucwords(htmlentities(trim($_POST['name'])));
  $msg = ucfirst(htmlentities(trim($_POST['message'])));
  $date = date('d-m-Y H:i:s');

  $to = "contact@greatunihack.com";
  $subject = "GreatUniHack December - New message from " . $name;
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

  echo json_encode(["success"]);
  exit();
}
catch (Exception $e) {
  echo json_encode(["error", $e->getMessage()]);
  exit();
}
?>