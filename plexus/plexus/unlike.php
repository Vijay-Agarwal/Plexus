<?php
	include 'init.php';

if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
$user_id=$_SESSION['user_id'];
$user=$getFromU->userData($user_id);
if(isset($_GET['id'])===true && empty($_GET['id'])===false){
	$postid=$_GET['id'];
	$postData=$getFromP->viewPost($postid);
	$profileData=$getFromU->userData($postData->user_id);
	$getFromP->postUnlike($postid);
	$getFromP->postUnlikeNotification($postData->user_id,$postid);
	if(isset($_GET['page'])===true && empty($_GET['page'])===false)
	{
		if(strcmp($_GET['page'],'home')==0)
			header('Location: home.php');
		else if(strcmp($_GET['page'],'profile')==0)
			header('Location: profile.php?id='.$postData->user_id);
		else if(strcmp($_GET['page'],'viewPost')==0)
			header('Location: viewPost.php?id='.$postid);

	}
	else
	{
		header('Location: home.php');
	}
}
else{
		header("Location: index.php");
}
?>