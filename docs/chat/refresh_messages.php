<?php
require "db.php";

// $id =44;
// while ($id<54) {

//     $message = R::load('chat',$id);
//     $usrs=R::load('users',$message['userid_id']);
          
//     echo $usrs['login'] . " say " . $message['text'];

//     $id++;
// }

$messages = R::findAll('chat');
foreach ($messages as $message) {
	$usrs=R::load('users',$message['userid_id']);
echo '<div style="">'.$usrs->login.'</div>'.'<div>'. $message->text. $message->time.'</div>'.'<br>';
}