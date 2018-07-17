<?php
	include 'init.php';

if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
if(isset($_GET['id'])===true && empty($_GET['id'])===false){
	$id=$_GET['id'];
	$getFromP->deletePost($id);
	header('Location: profile.php?id='.$_SESSION['user_id']);
}
else{
		header("Location: index.php");

}

?>