<?php
  include 'init.php';

$user_id= $_SESSION['user_id'];
$user=$getFromU->userData($user_id);
if($getFromU->loggedIn()===false){
  header('Location: index.php');
}
if(isset($_GET['dep'])===true && !empty($_GET['dep'])===true) {
    if(isset($_GET['sem'])===true && !empty($_GET['sem'])===true)
    {
        $dep=$_GET['dep'];
        $sem=$_GET['sem'];
        $user_id=$_SESSION['user_id'];
        $user=$getFromU->userData($user_id);
    }
    else
    {
        header("Location: index.php");
   
    }
    
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
                                    <a href="<?php echo 'notes.php'; ?>">
                                        <i class="material-icons" aria-hidden="true">note</i>Notes</a>
                                </li>
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



                            </div>
                            <!-- in left wrap-->
                        </div>
                        <!-- in left end-->
                        <div class="in-center">
                            <div class="in-center-wrap">

                                <?php
if(isset($_POST['newNotes']) && !empty($_POST['newNotes'])){
  $notes=$_POST['notes'];
  $subject=$_POST['subject'];
  if(!empty($notes) and !empty($subject)){
    $getFromP->newNotes($subject,$notes,$dep,$sem);

      }else{
    $error="Please enter some data to post.";
  }
}
?>
                                <!-- Add new notes -->
                                <div class="tweet-wrap">
                                    <div class="tweet-inner">
                                        <div class="tweet-h-left">
                                            <div class="tweet-h-img">
                                                <!-- PROFILE-IMAGE -->
                                                <img src="<?php echo $user->profileImage; ?>" />
                                            </div>
                                        </div>
                                        <div class="tweet-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <input type="text" class="status" name="subject" style="width:95%; border-radius: 5px;" placeholder="Subject name">

                                                <textarea class="status" name="notes" placeholder="Add Notes link!" rows="4" cols="50"></textarea>
                                                <div class="hash-box">
                                                    <ul>
                                                    </ul>
                                                </div>
                                        </div>
                                        <div class="tweet-footer">
                                            <div class="t-fo-left">
                                                <ul>
                                                    <span class="tweet-error">
                                                        <?php
                                                            if(isset($error)){
                                                                echo '<div style="color:red;">'.$error.'</div>';
                                                            }
                                                        ?>
                                                    </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="t-fo-right">
                                                <input type="submit" name="newNotes" value="Notes" />

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--TWEET WRAP END-->



        <!--Tweet SHOW WRAPPER-->
         <div class="tweets">
            <!--TWEETS HERE-->


<?php $result=$getFromP->allNotes($dep,$sem);
foreach($result as $user){
  $temp=$getFromU->userData($user->user_id);
echo'
<div class="t-show-wrap" style="margin-top:20px; margin-bottom:20px; border:solid 2px; border-color: grey; background-color: lightblue; border-radius: 5px;"> 
 <div class="t-show-inner">

  <div class="t-show-popup" >
    <div class="t-show-head">
<a href="viewPost.php?id='.$user->post_id.'"><span><i style="margin-left: 90%;" class="material-icons">assignment</i></span>      </a>

      <div class="t-show-img">
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
      <a href="'.$user->notes_link.'" target="_blank"><i class="material-icons" aria-hidden="true" style="font-size:800%; color:grey;">note</i></a>
    </div>
    <!--tweet show body end-->
  </div>
  <div class="t-show-footer">
    <div class="t-s-f-right">
      <ul><li style="font-size:20px;">'.$getFromP->likeCount($user->post_id); 
      if($getFromP->likeButton($user->post_id)==0)
      {
        echo' <a href="like.php?id='.$user->post_id.'&page=home"><i class="material-icons" aria-hidden="true">thumb_up</i></a></li> ';
      }else
      {
        echo' <a href="unlike.php?id='.$user->post_id.'&page=home"><i class="material-icons" aria-hidden="true">thumb_down</i></a></li> ';
      }
         
        echo'<li style="font-size:20px;">'.$getFromP->commentCount($user->post_id).'<a href="viewPost.php?id='.$user->post_id.'"><i class="material-icons" aria-hidden="true">comment</i></a></li>
      </ul>
    </div>
  </div>
</div>
</div>';}
?>



         </div>
        <!--TWEETS SHOW WRAPPER-->











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