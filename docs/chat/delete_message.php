<?php

require "db.php";

$data=$_POST;

if (isset($data['id']) ) {
    $message = R::load('chat', $data['id']);
    R::trash($message);
}

?>