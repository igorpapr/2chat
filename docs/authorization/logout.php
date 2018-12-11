<?php 
  require "db.php";
  unset($_SESSION["logged_user"]);
  header('Location: /');//redirect to main page
?>