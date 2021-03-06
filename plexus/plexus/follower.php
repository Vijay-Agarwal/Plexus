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
                                            <img src="<?php echo $profileData->coverImage; ?>" />
                                        </div>
                                        <!-- info in head end -->
                                        <div class="info-in-body">
                                            <div class="in-b-box">
                                                <div class="in-b-img">
                                                    <!-- PROFILE-IMAGE -->
                                                    <img src="<?php echo $profileData->profileImage; ?>" />
                                                </div>
                                            </div>
                                            <!--  in b box end-->
                                            <div class="info-body-name">
                                                <div class="in-b-name">
                                                    <div>
                                                        <a href="<?php echo BASE_URL.'profile.php?id='.$profileData->user_id; ?>">
                                                            <?php echo $profileData->name; ?>
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
                                                <?php echo $profileData->bio; ?>
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


                                <!--NOTIFICATION WRAPPER FULL WRAPPER-->
                                <div class="notification-full-wrapper " style="margin-top:50px">



                                    <!-- Follow Notification -->
                                    <!--NOTIFICATION WRAPPER-->
                                    <span style="font-size: 20px;">Followers:</span>
                                            <?php
                                              if($getFromU->followers($id)==0)
                                              {
                                                echo '<div class="notification-wrapper" >
                                                        <div class="notification-inner">
                                                          <div class="notification-tweet"> 
                                                            <span>No Followers</span>
                                                          </div>
                                                        </div>
                                                      </div>';
                                              }
                                              else
                                              {

                                              	$result=$getFromF->getFollowers($id);

                                              foreach($result as $user){
                                                $temp=$getFromU->userData($user->user_id);

    echo '<div class="notification-wrapper">
            <div class="notification-inner">
              <div class="notification-header">
                <div class="notification-name">
                  <div>
                    <a href="'.BASE_URL.'profile.php?id='.$temp->user_id.'" class="notifi-name"><img src="'.$temp->profileImage.'"/>'.'<span style="margin-left:40px">'.$temp->name.'</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>';

    }}
                                            ?>
                                    <!--NOTIFICATION WRAPPER END-->
                                    <!-- Follow Notification -->



                                </div>
                                <!--NOTIFICATION WRAPPER FULL WRAPPER END-->


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
