<?php
require "db.php";

$messages = R::findAll('chat');
foreach ($messages as $message) {
	$usrs=R::load('users',$message['userid_id']);
    echo '<div class="usertxt" msgid="'.$message['id'].'">
             <div class="user">'.$usrs->login.'</div>'
             .'<div class="usrmssg">'. $message->text.'</div></div>'.'<div class="time">'. $message->time.'</div>'.'<br>';

}