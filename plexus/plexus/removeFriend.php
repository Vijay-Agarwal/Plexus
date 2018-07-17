<?php
	include 'init.php';

if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
if(isset($_GET['id'])===true && empty($_GET['id'])===false){
	$id=$_GET['id'];
	$profileData=$getFromU->userData($id);
	$user_id=$_SESSION['user_id'];
	if(!$profileData){
		header("Location: index.php");
	}else{
		$getFromF->removeFriend($id);
	}
}
else{
		header("Location: index.php");

}

?>