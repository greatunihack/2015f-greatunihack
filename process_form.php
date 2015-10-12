<?php
try
{
  if(!isset($_POST['name'], $_POST['email'], $_POST['message']) 
    || !$_POST['name'] || !$_POST['email'] || !$_POST['message']) {
    throw new Exception("Error. Invalid input.", 1);
  }

}



?>