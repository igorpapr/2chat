<?php
require "rb.php";
R::setup('mysql: host=2chat.com.ua;dbname=users',
    'mysql', 'mysql');

session_start();
