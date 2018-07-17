<?php
include 'init.php';
if($getFromU->loggedIn()===false){
    header('Location: index.php');
}
$user_id=$_SESSION['user_id'];
$user=$getFromU->userData($user_id);
if(isset($_FILES['profileImage'])){
    if(!empty($_FILES['profileImage']['name'][0])){
        $fileRoot=$getFromU->uploadImage($_FILES['profileImage']);
        $getFromU->update('users',$user_id,array('profileImage'=>$fileRoot));
            header('Location: profileEdit.php');

    }
}

if(isset($_FILES['profileCover'])){
    if(!empty($_FILES['profileCover']['name'][0])){
        $fileRoot=$getFromU->uploadImage($_FILES['profileCover']);
        $getFromU->update('users',$user_id,array('CoverImage'=>$fileRoot));
            header('Location: profileEdit.php');
    }
}

if(isset($_POST['name'])){
    if(empty($_POST['name'])) {
        $error="Name field can't be blank";
    }else if(empty($_POST['mobile'])){
        $error="Mobile number field can't be blank";
    }else{
        $name=$getFromU->checkInput($_POST['name']);
        $bio=$getFromU->checkInput($_POST['bio']);
        $mobile=$getFromU->checkInput($_POST['mobile']); 
        if(strlen($name)>20){
            $error='Name must upto 20 characters';
        }else if(strlen($bio)>50){
            $error='Discription must upto 50 characters';
        }else{
            $getFromU->update('users',$user_id,array('name'=>$name,'bio'=>$bio,'mobile'=>$mobile));
            header('Location: profileEdit.php');
        }
    }
}


?>
    <!doctype html>
    <html>

    <head>
        <title>Profile edit page</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css/style-complete.css" />
        <link rel="stylesheet" href="css/materialIcon.css" />
        <script src="js/jquery.min.js" crossorigin="anonymous"></script>
    </head>
    <!--Helvetica Neue-->

    <body>
        <div class="wrapper">
            <!-- header wrapper -->
            <div class="header-wrapper">

                <div class="nav-container">
                    <!-- Nav -->
                    <div class="nav">
                        <div class="nav-left">
                            <ul>
                                <li>
                                    <img src="images/info.png" alt="Plexus" width="60px">
                                </li>

                                <li>

                                    <a href="<?php echo BASE_URL; ?>home.php">
                                        <i class="material-icons">home</i>Home</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL.'notification.php'; ?>">
                                        <i class="material-icons">notifications</i>Notification</a>
                                </li>
                                <li>
                                    <a href="<?php echo 'notes.php'; ?>"><i class="material-icons" aria-hidden="true">note</i>Notes</a></li>
                            </ul>
                        </div>
                        <!-- nav left ends-->
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
                                        <img src="<?php echo $user->profileImage; ?>" />
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
                                                    <a href="changePassword.php">Change Password</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo BASE_URL; ?>logout.php">Log out</a>
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


            <!--Profile cover-->
            <div class="profile-cover-wrap">
                <div class="profile-cover-inner">
                    <div class="profile-cover-img">
                        <!-- PROFILE-COVER -->
                        <img src="<?php echo $user->coverImage; ?>" />

                        <div class="img-upload-button-wrap">
                            <div class="img-upload-button1">
                                <label for="cover-upload-btn">
                                    <i class="material-icons" aria-hidden="true">camera_alt</i>
                                </label>
                                <span class="span-text1">
                                    Change your Cover photo
                                </span>
                                <input id="cover-upload-btn" type="checkbox" />
                                <div class="img-upload-menu1">
                                    <span class="img-upload-arrow"></span>
                                    <form method="post" enctype="multipart/form-data">
                                        <ul>
                                            <li>
                                                <label for="file-up">
                                                    Upload photo
                                                </label>
                                                <input type="file" name="profileCover" onchange="this.form.submit();" id="file-up" />
                                            </li>
                                            <li>
                                                <label for="cover-upload-btn">
                                                    Cancel
                                                </label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-nav">
                    <div class="profile-navigation">
                        <ul>

                            <li>
                                <a href="#">
                                    <div class="n-head">
                                        <a href="<?php echo BASE_URL.'following.php?id='.$user_id; ?>">FOLLOWING</a>

                                    </div>
                                    <div class="n-bottom">
                                        <?php echo $getFromU->following($user_id); ?>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="n-head">
                                        <a href="<?php echo BASE_URL.'follower.php?id='.$user_id; ?>">FOLLOWERS</a>

                                    </div>
                                    <div class="n-bottom">
                                        <?php echo $getFromU->followers($user_id); ?>
                                    </div>
                                </a>
                            </li>


                        </ul>
                        <div class="edit-button">
                            <span>
                                <input type="submit" id="save" value="Save Changes">
                            </span>

                        </div>
                    </div>
                </div>
            </div>
            <!--Profile Cover End-->

            <div class="in-full-wrap">
                <div class="in-left">
                    <!--PROFILE INFO WRAPPER END-->
                    <div class="profile-info-wrap">
                            <div class="profile-img">
                                
                                <!-- PROFILE-IMAGE -->
                                <img src="<?php echo $user->profileImage; ?>" />
                                <div class="img-upload-button-wrap1">
                                    <div class="img-upload-button">
                                        <label for="img-upload-btn">
                                            <i class="material-icons" aria-hidden="true">camera_alt</i>
                                        </label>
                                        <span class="span-text">
                                            Change your profile photo
                                        </span>
                                        <input id="img-upload-btn" type="checkbox" />
                                        <div class="img-upload-menu">
                                            <span class="img-upload-arrow"></span>
                                            <form method="post" enctype="multipart/form-data">
                                                <ul>
                                                    <li>
                                                        <label for="profileImage">
                                                            Upload photo
                                                        </label>
                                                        <input id="profileImage" onchange="this.form.submit();" type="file" name="profileImage" />

                                                    </li>
                                                    <li>
                                                        <label for="img-upload-btn">
                                                            Cancel
                                                        </label>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- img upload end-->
                                </div>
                            </div>

                            <form id="editForm" method="post" enctype="multipart/Form-data">
                                <div class="profile-name-wrap">
                                    <?php
                                                if(isset($imageError)){
                                                    echo '  <ul>
                                                                <li class="error-li">
                                                                    <div class="span-pe-error">'.$imageError.'</div>
                                                                </li>
                                                            </ul>';
                                                }
                                    ?>

                                        <div class="profile-name">
                                            <input type="text" name="name" value="<?php echo $user->name; ?>" />
                                            <div class="profile-bio-inner">
                                                <textarea class="status" name="bio"><?php echo $user->bio; ?></textarea>
                                            </div>

                                            <input id="mobile" type="text" name="mobile" placeholder="Mobile number" value="<?php echo $user->mobile; ?>" />
                                            <?php
                                                        if(isset($error)){
                                                            echo '  <li class="error-li">
                                                                        <div class="span-pe-error">'.$error.'</div>
                                                                    </li>';
                                                        }
                                                    ?>
                                        </div>
                                </div>


                            </form>
                            <script type="text/javascript">
                                $('#save').click(function () {
                                    $('#editForm').submit();
                                })

                            </script>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>