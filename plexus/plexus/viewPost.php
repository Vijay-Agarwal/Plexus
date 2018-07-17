<?php
  include 'init.php';

if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
$user_id=$_SESSION['user_id'];
$user=$getFromU->userData($user_id);
if(isset($_GET['id'])===true && empty($_GET['id'])===false){
  $id=$_GET['id'];
  $postData=$getFromP->viewPost($id);
  $profileData=$getFromU->userData($postData->user_id);
}
else{
    header("Location: index.php");
}
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Plexus</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css/style-complete.css" />
        <link rel="stylesheet" href="css/materialIcon.css" />
        <script src="js/jquery.min.js" crossorigin="anonymous"></script>

    </head>

    <body>
        <div class="wrapper">
            <div class="header-wrapper">
                <div class="nav-container">
                    <div class="nav">
                        <div class="nav-left">
                            <ul>
                                <li>
                                    <img src="images/info.png" alt="Plexus" width="60px">
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL.'home.php'; ?>">
                                        <i class="material-icons">home</i>Home</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL.'notification.php'; ?>">
                                        <?php 
            if($getFromU->notification()=== true)
              echo '<i class="material-icons" style="color: blue"aria-hidden="true">notifications_active</i>';
            else
              echo '<i class="material-icons" aria-hidden="true">notifications</i>';
        ?>Notification</a>
                                </li>
                                <li>
                                    <a href="<?php echo 'notes.php'; ?>"><i class="material-icons" aria-hidden="true">note</i>Notes</a></li>
                            </ul>
                        </div>
                        <div class="nav-right">
                            <ul>
                                <li>
                                    <input type="text" placeholder="Search" class="search" />
                                    <i class="material-icons" aria-hidden="true">search</i>
                                    <div class="search-result">
                                    </div>
                                </li>
                                <li class="hover">
                                    <label class="drop-label" for="drop-wrap1">
                                        <img src="<?php echo $user->profileImage;  ?>" />
                                    </label>
                                    <input type="checkbox" id="drop-wrap1">
                                    <div class="drop-wrap">
                                        <div class="drop-inner">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo BASE_URL.'profile.php?id='.$user->user_id; ?>">
                                                        <?php echo $user->name; ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo BASE_URL.'profileEdit.php'; ?>">Settings</a>
                                                </li>
                                                <li>
                                                    <a href="logout.php">Log out</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- nav right ends-->
                    </div>
                    <!-- nav ends -->
                </div>
                <!-- nav container ends -->

            </div>
            <!-- header wrapper end -->
            <script type="text/javascript" src="js/search.js"></script>

            <!---Inner wrapper-->
            <div class="inner-wrapper">
                <div class="in-wrapper">
                    <div class="in-full-wrap">
                        <div class="in-left">
                            <div class="in-left-wrap">
                                <div class="info-box">
                                    <div class="info-inner">
                                        <div class="info-in-head">
                                            <!-- PROFILE-COVER-IMAGE -->
                                            <img src="<?php echo $user->coverImage; ?>" />
                                        </div>
                                        <!-- info in head end -->
                                        <div class="info-in-body">
                                            <div class="in-b-box">
                                                <div class="in-b-img">
                                                    <!-- PROFILE-IMAGE -->
                                                    <img src="<?php echo $user->profileImage; ?>" />
                                                </div>
                                            </div>
                                            <!--  in b box end-->
                                            <div class="info-body-name">
                                                <div class="in-b-name">
                                                    <div>
                                                        <a href="<?php echo BASE_URL.'profile.php?id='.$user->user_id; ?>">
                                                            <?php echo $user->name; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- in b name end-->
                                            </div>
                                            <!-- info body name end-->
                                        </div>
                                        <!-- info in body end-->
                                        <div class="info-in-footer">
                                            <div>
                                                <?php echo $user->bio; ?>
                                            </div>
                                        </div>
                                        <!-- info in footer -->
                                    </div>
                                    <!-- info inner end -->
                                </div>
                                <!-- info box end-->

                                <!--==TRENDS==-->
                                <!---TRENDS HERE-->
                                <!--==TRENDS==-->

                            </div>
                            <!-- in left wrap-->
                        </div>
                        <!-- in left end-->

                        <div class="in-center">
                            <div class="in-center-wrap">

                                <?php echo '<div class="t-show-wrap" style="margin-top:40px; border:solid 2px; border-color: grey; background-color: lightblue; border-radius: 5px;"> 
 <div class="t-show-inner" >
  <div class="t-show-popup" >
    <div class="t-show-head">
      <div class="t-show-img" >
        <img src="'.$profileData->profileImage.'"/>
      </div>
      <div class="t-s-head-content">
        <div class="t-h-c-name">
          <span><a href="'.BASE_URL.'profile.php?id='.$profileData->user_id.'">'.$profileData->name.'</a></span>
        </div>
        <div class="t-h-c-dis">
        </div>
      </div>
    </div>
    <div class="t-show-body" >
      <div class="t-s-b-inner">
       <div class="t-s-b-inner-in">'.$postData->message.'
       </div>
      </div>
      <img src="'.$getFromP->getImage($postData->post_id).'" style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 60%; "class="imagePopup"/>';
      if($postData->type==1)
      {
        echo '<a href="'.$postData->notes_link.'" target="_blank"><i class="material-icons" aria-hidden="true" style="font-size:800%; color:grey;">note</i></a>';
      }
    echo '
    </div>
    <!--tweet show body end-->
  </div>
  <div class="t-show-footer" >
    <div class="t-s-f-right" >
     <ul><li style="font-size:20px;">'.$getFromP->likeCount($postData->post_id); 
      if($getFromP->likeButton($postData->post_id)==0)
      {
        echo' <a href="like.php?id='.$postData->post_id.'&page=viewPost"><i class="material-icons" aria-hidden="true">thumb_up</i></a></li> ';
      }else
      {
        echo' <a href="unlike.php?id='.$postData->post_id.'&page=viewPost"><i class="material-icons" aria-hidden="true">thumb_down</i></a></li> ';
      }
         
        ?>
<?php
if(isset($_POST['newComment']) && !empty($_POST['newComment'])){
  $commentMessage=$_POST['commentMessage'];
  if(!empty($commentMessage)){
    // $error=$commentMessage;
    $getFromP->postComment($id,$commentMessage);
    $getFromP->postCommentNotification($postData->user_id,$id);
      }else{
    $error="Please enter some message to comment.";
  }
}
?>
        <div class="tweet-body">
             <form method="post" enctype="multipart/form-data" >
              <textarea name="commentMessage" placeholder="Comment here!!!" rows="4" cols="50"></textarea>
             <div class="tweet-footer">
              
              <div class="t-fo-right">
                <input type="submit" name="newComment" value="Comment"/>
                <?php
if(isset($error)){
  echo '<div style="color:red;">'.$error.'</div>';
}
?>
              </div></div>
                
            </form>
        </div>


      <?php echo '</ul>
    </div>
  </div>

</div >
<button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:5%; margin-right:3%; margin-bottom:3%;"onclick="toggleLike()">Likes</button>
<button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:3%; margin-right:5%; margin-bottom:3%;"onclick="toggleComment()">Comments</button></div>

<div class=" t-s-b-inner-in" id="like" style=" font-size:20px; display: none;">
Likes:';

if($getFromP->likeCount($id)==0)
{
echo '<div class="notification-wrapper" style="background-color:lightblue;">
        <div class="notification-inner">
        <div class="notification-tweet"> 
         <span>No likes</span>
         </div>
        </div>
      </div>';
}
else
{
  $likes=$getFromP->allLikes($id);
foreach($likes as $temp){
$user=$getFromU->userData($temp->user_id);
  echo '<div class="notification-wrapper" style="background-color:lightblue;">
            <div class="notification-inner">
              <div class="notification-header">
                <div class="notification-name">
                  <div>
                    <a href="'.BASE_URL.'profile.php?id='.$user->user_id.'" class="notifi-name"><img src="'.$user->profileImage.'"/>'.'<span style="margin-left:40px">'.$user->name.'</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>';

}
}


echo'</div>
<div class=" " id="comment" style=" font-size:20px; display: block;">
Comments:';
if($getFromP->commentCount($id)==0)
{
echo '<div class="notification-wrapper" style="background-color:lightblue;">
        <div class="notification-inner">
        <div class="notification-tweet"> 
         <span>No Comments</span>
         </div>
        </div>
      </div>';
}
else
{
  $comment=$getFromP->allComments($id);
foreach($comment as $temp){
$user=$getFromU->userData($temp->user_id);
  echo '<div class="notification-wrapper" style="background-color:lightblue;">
            <div class="notification-inner">
              <div class="notification-header">
                <div class="notification-name">
                  <div>
                    <a href="'.BASE_URL.'profile.php?id='.$user->user_id.'" class="notifi-name"><img src="'.$user->profileImage.'"/><span style="margin-left:40px">'.$user->name.' - </span></a><span style="font-size:15px;">'.$temp->comment.'</span>
                  </div>
                </div>
              </div>
            </div>
          </div>';

}
}

echo'</div>';?>
<script type="text/javascript">
<!--
    function toggleLike() {
       var e = document.getElementById("like");
          e.style.display = "block";
        var e = document.getElementById("comment");
          e.style.display = "none";
    }
    function toggleComment() {
       var e = document.getElementById("like");
          e.style.display = "none";
          var e = document.getElementById("comment");
          e.style.display = "block";
    }
//-->
</script>
                            </div>
                            <!-- in left wrap-->
                        </div>
                        <!-- in center end -->

                        <div class="in-right">
                            <div class="in-right-wrap">

                                <!--Who To Follow-->
                                <!--WHO_TO_FOLLOW HERE-->
                                <!--Who To Follow-->

                            </div>
                            <!-- in left wrap-->

                        </div>
                        <!-- in right end -->

                    </div>
                    <!--in full wrap end-->

                </div>
                <!-- in wrappper ends-->
            </div>
            <!-- inner wrapper ends-->
        </div>
        <!-- ends wrapper -->
    </body>

    </html>