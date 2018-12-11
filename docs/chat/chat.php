<?php 
  require "db.php";

    
    if($_POST['common_text']!=''){
    $message = R::dispense('chat');
    $message->userid = $_SESSION['logged_user'];
   $message->text = htmlspecialchars($_POST['common_text']);
    $message->time = date("h:i:sa");
    R::store($message);
    
}
?>