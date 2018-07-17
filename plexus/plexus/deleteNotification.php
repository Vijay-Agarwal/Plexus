<?php
	include 'init.php';

if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
$user_id=$_SESSION['user_id'];
$user=$getFromU->deleteNotification($user_id);


?>