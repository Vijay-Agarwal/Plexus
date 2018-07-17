<?php
include 'init.php';
$user_id= $_SESSION['user_id'];
$user=$getFromU->userData($user_id);

if($getFromU->loggedIn()===false){
  header('Location: index.php');
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
if(isset($_POST['change']) && !empty($_POST['change'])){
  $old=$_POST['oldpassword'];
  $new=$_POST['newpassword'];
  $reenter=$_POST['reenterpassword'];
  if(empty($old) or empty($new) or empty($reenter)){
    $error="All fields are mandatory!!!";
      }
      else
      {
      	if(strcmp($getFromU->getPassword(), $old)!=0){
      		$error="Old password is not correct!!!";
      	}
      	else if(strcmp($new, $reenter)!=0){
      		$error="Password didn't match!!!";
      	}
      	else
      	{
      		$getFromU->changePassword($new);
      		$error="Password changed succesfully";
      	}
      }
    }
?>



                                <!--TWEET WRAPPER-->
                                <div class="tweet-wrap" style="margin-top: 40%;">
                                    <div class="tweet-inner">
                                        <div class="notification-wrapper">
                                            <div class="notification-inner">
                                                <div class="notification-tweet">
                                                    <span>Change Password</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tweet-h-left">

                                            <div class="tweet-h-img">
                                                <!-- PROFILE-IMAGE -->
                                            </div>
                                        </div>
                                        <div class="tweet-body" >
                                            <form method="post" enctype="multipart/form-data" >
                                                <span style="font-size:150%;">Old Password:</span>
                                                <input type="password" class="status" name="oldpassword" style="margin-left:20%;">
                                                <br> 
<span style="font-size:150%;">New Password:</span>
                                                <input type="password" class="status" name="newpassword" style="margin-left:18%;">
                                                <br> 
<span style="font-size:150%;">Re-enter Password:</span>
                                                <input type="password" class="status" name="reenterpassword" style="margin-left:10%;">
                                                <div class="tweet-footer">
                                                    <div class="t-fo-left">

                                                        <span class="tweet-error">
                                                            <?php
																if(isset($error)){
  																	echo '<div style="color:red;">'.$error.'</div>';
																}
															?>
                                                        </span>
                                                    </div>
                                                    <div class="t-fo-right">
                                                        <input type="submit" name="change" value="Change" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--TWEET WRAP END-->


                                <!--Tweet SHOW WRAPPER-->
                                <div class="tweets">
                                    <!--TWEETS HERE-->


                                </div>
                                <!--TWEETS SHOW WRAPPER-->


                                <!--Tweet END WRAPER-->

                            </div>
                            <!-- in left wrap-->
                        </div>
                        <!-- in center end -->



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