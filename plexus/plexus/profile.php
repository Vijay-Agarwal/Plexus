<?php
	include 'init.php';

if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
if(isset($_GET['id'])===true && empty($_GET['id'])===false){
	$id=$_GET['id'];
	$profileData=$getFromU->userData($id);
	$user_id=$_SESSION['user_id'];
	$user=$getFromU->userData($user_id);
	if(!$profileData){
		header("Location: index.php");
	}
}
else{
		header("Location: index.php");

}

?>
<!doctype html>
<html>
	<head>
		<title>Plexus</title>
		<meta charset="UTF-8" />
 		<link rel="stylesheet" href="css/style-complete.css"/>
        <link rel="stylesheet" href="css/materialIcon.css"/> 
        <script src="js/jquery.min.js"  crossorigin="anonymous"></script>     

    </head>
<!--Helvetica Neue-->
<body>
<div class="wrapper">
<!-- header wrapper -->
<div class="header-wrapper">	
	<div class="nav-container">
    	<div class="nav">
		<div class="nav-left">
			<ul>
				        <li> <img src="images/info.png" alt="Plexus" width="60px" ></li>
				<li><a href="<?php echo BASE_URL; ?>home.php"><i class="material-icons">home</i>Home</a></li>
				<li><a href="<?php echo BASE_URL.'notification.php'; ?>"><?php 
            if($getFromU->notification()=== true)
              echo '<i class="material-icons" style="color: blue"aria-hidden="true">notifications_active</i>';
            else
              echo '<i class="material-icons" aria-hidden="true">notifications</i>';
        ?>Notification</a></li>
				<li><a href="<?php echo 'notes.php'; ?>"><i class="material-icons" aria-hidden="true">note</i>Notes</a></li>
				 
			</ul>
		</div><!-- nav left ends-->
		<div class="nav-right">
			<ul>
				<li><input type="text" placeholder="Search" class="search"/><i class="material-icons" aria-hidden="true">search</i>
					<div class="search-result"> 

					</div>
				</li>

				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user->profileImage; ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo BASE_URL.'profile.php?id='.$user->user_id; ?>"><?php echo $user->name; ?></a></li>
              				<li><a href="<?php echo BASE_URL.'profileEdit.php'; ?>">Settings</a></li>
							<li><a href="<?php echo BASE_URL; ?>logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
			</ul>
		</div><!-- nav right ends-->

	</div><!-- nav ends -->
	</div><!-- nav container ends -->
</div><!-- header wrapper end -->
<script type="text/javascript" src="js/search.js"></script>

<!--Profile cover-->
<div class="profile-cover-wrap"> 
<div class="profile-cover-inner">
	<div class="profile-cover-img">
		<!-- PROFILE-COVER -->
		<img src="<?php echo $profileData->coverImage; ?>"/>
	</div>
</div>
<div class="profile-nav">
 <div class="profile-navigation">
	<ul>
		<li>
			<a href="<?php echo BASE_URL.$profileData->name; ?>/following">
				<div class="n-head">
					<a href="<?php echo BASE_URL.'following.php?id='.$profileData->user_id; ?>">FOLLOWING</a>
				</div>
				<div class="n-bottom">
					<span class="count-following"><?php echo $getFromU->following($profileData->user_id); ?></span>
				</div>
			</a>
		</li>
		<li>
		 <a href="<?php echo BASE_URL.$profileData->name; ?>/followers">
				<div class="n-head">
					<a href="<?php echo BASE_URL.'follower.php?id='.$profileData->user_id; ?>">FOLLOWERS</a>
				</div>
				<div class="n-bottom">
					<span class="count-followers"><?php echo $getFromU->followers($profileData->user_id); ?></span>
				</div>
			</a>
		</li>
	</ul>
	<?php 
		if($id!=$user_id){
			if($getFromU->friend($profileData->user_id)===false){
				echo '<div class="edit-button">
		<span>
			<a href="addFriend.php?id='.$id.'"><button class=" follow-btn" ><i class="material-icons">person_add</i>Follow</button></a>
		</span>
	</div>';
		}else{
			echo '<div class="edit-button">
		<span>
		<a href="removeFriend.php?id='.$id.'"><button class=" follow-btn" ><i class="material-icons">check</i>Unfollow</button></a>
		</span>
	</div>';
			
		}
		}
	?>
    </div>
</div>
</div><!--Profile Cover End-->

<!---Inner wrapper-->
<div class="in-wrapper">
 <div class="in-full-wrap">
   <div class="in-left">
     <div class="in-left-wrap">
	<!--PROFILE INFO WRAPPER END-->
	<div class="profile-info-wrap">
	 <div class="profile-info-inner">
	 <!-- PROFILE-IMAGE -->
		<div class="profile-img">
			<img src="<?php echo BASE_URL.$profileData->profileImage; ?>"/>
		</div>	

		<div class="profile-name-wrap">
			<div class="profile-name">
				<a href="<?php echo BASE_URL.'profile.php?id='.$profileData->user_id; ?>"><?php echo $profileData->name; ?></a>
			</div>
		</div>

		<div class="profile-bio-wrap">
		 <div class="profile-bio-inner">
		    <?php echo $profileData->bio; ?>
		 </div>
		</div>



<div class="profile-extra-footer">
	<div class="profile-extra-footer-head">
		<div class="profile-extra-info">
			<ul>
				<li>
					<div class="profile-ex-location-i">
						<i class="fa fa-camera" aria-hidden="true"></i>
					</div>
					<div class="profile-ex-location">
						<!-- <a href="#">0 Photos and videos </a> -->
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="profile-extra-footer-body">
		<ul>
			 <!-- <li><img src="#"/></li> -->
		</ul>		
	</div>
</div>

	 </div>
	<!--PROFILE INFO INNER END-->

	</div>
	<!--PROFILE INFO WRAPPER END-->

	</div>
	<!-- in left wrap-->

  </div>
	<!-- in left end-->

<div class="in-center">
	<div class="in-center-wrap">
	<?php 
		$result=$getFromP->userPost($profileData->user_id);
	foreach($result as $user){
  $temp=$getFromU->userData($user->user_id);
echo'
<div class="t-show-wrap" style="margin-top:20px; margin-bottom:20px; border:solid 2px; border-color: grey; background-color: lightblue; border-radius: 5px;"> 
 <div class="t-show-inner">
  <div class="t-show-popup" >
    <div class="t-show-head">
    <a href="viewPost.php?id='.$user->post_id.'"><i style="margin-left: 80%;" class="material-icons">assignment</i></a>';

              
    if($id==$user_id && $user->type==0)
    {
		echo '<a href="deletePost.php?id='.$user->post_id.'"><i style="margin-left: 5%; " class="material-icons">delete</i></a>';
    }
              

      echo '<div class="t-show-img" style="">
        <img src="'.$temp->profileImage.'"/>
      </div>
      <div class="t-s-head-content">
        <div class="t-h-c-name">
          <span><a href="'.BASE_URL.'profile.php?id='.$temp->user_id.'">'.$temp->name.'</a></span>
        </div>
        <div class="t-h-c-dis">
        </div>
      </div>
    </div>
    <div class="t-show-body">
      <div class="t-s-b-inner">
       <div class="t-s-b-inner-in">'.$user->message.'
       </div>
      </div>
      <img src="'.$getFromP->getImage($user->post_id).'" style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 60%; "class="imagePopup"/>';
      if($user->type==1)
      {
        echo '<a href="'.$user->notes_link.'" target="_blank"><i class="material-icons" aria-hidden="true" style="font-size:800%; color:grey;">note</i></a>';
      }
    echo '
    </div>
    <!--tweet show body end-->
  </div>
  <div class="t-show-footer">
    <div class="t-s-f-right">
      <ul><li style="font-size:20px;">'.$getFromP->likeCount($user->post_id); 
      if($getFromP->likeButton($user->post_id)==0)
      {
        echo' <a href="like.php?id='.$user->post_id.'&page=profile"><i class="material-icons" aria-hidden="true">thumb_up</i></a></li> ';
      }else
      {
        echo' <a href="unlike.php?id='.$user->post_id.'&page=profile"><i class="material-icons" aria-hidden="true">thumb_down</i></a></li> ';
      }
         
        echo'<li style="font-size:20px;">'.$getFromP->commentCount($user->post_id).'<a href="viewPost.php?id='.$user->post_id.'"><i class="material-icons" aria-hidden="true">comment</i></a></li>
      </ul>
    </div>
  </div>
</div>
</div>';
}
?>
	<!--Tweet SHOW WRAPER-->
	<!--Tweet SHOW WRAPER END-->
	</div><!-- in left wrap-->
  
</div>
<!-- in center end -->

<div class="in-right">
	<div class="in-right-wrap">
			
		<!--==WHO TO FOLLOW==-->
	      <!--who to follow-->
		<!--==WHO TO FOLLOW==-->
			
		<!--==TRENDS==-->
	 	   <!--Trends-->
	 	<!--==TRENDS==-->
			
	</div><!-- in right wrap-->
</div>
<!-- in right end -->

		</div>
		<!--in full wrap end-->
	</div>
	<!-- in wrappper ends-->	
 </div>
 <!-- ends wrapper -->
</body>
</html>

