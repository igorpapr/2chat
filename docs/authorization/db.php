<?php
require "rb.php";
R::setup('mysql: host=192.168.43.90;dbname=users',
    'mysql', 'mysql');

session_start();
