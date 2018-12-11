<?php
require "rb.php";
R::setup('mysql: host=2chat.com.ua;dbname=users',
    'mysql', 'mysql');
$db = mysqli_connect("2chat.com.ua","mysql","mysql","users");

session_start();
