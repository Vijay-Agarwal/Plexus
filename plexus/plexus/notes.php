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
<div class="notification-wrapper" style="background-color:lightblue; border: solid 1px; margin-top: 10%;">
<button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="toggleComputer()">Computer Science</button>
<button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="toggleMechanical()">Mechanical</button>
<button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="toggleElectrical()">Electrical</button>
<button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="toggleCivil()">Civil</button>
</div>
<div class="notification-wrapper" style="background-color:lightblue; border: solid 1px; margin-top: 10%; display: none;" id="computer">
    Computer Science:
<a href="viewNotes.php?dep=1&sem=1"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:0%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 1</button></a>
<a href="viewNotes.php?dep=1&sem=2"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 2</button></a>
<a href="viewNotes.php?dep=1&sem=3"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 3</button></a>
<a href="viewNotes.php?dep=1&sem=4"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 4</button></a>
<a href="viewNotes.php?dep=1&sem=5"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 5</button></a>
<a href="viewNotes.php?dep=1&sem=6"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 6</button></a>
</div>
<div class="notification-wrapper" style="background-color:lightblue; border: solid 1px; margin-top: 10%; display: none;" id="mechanical">
    Mechanical:
<a href="viewNotes.php?dep=2&sem=1"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:7%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 1</button></a>
<a href="viewNotes.php?dep=2&sem=2"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 2</button></a>
<a href="viewNotes.php?dep=2&sem=3"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 3</button></a>
<a href="viewNotes.php?dep=2&sem=4"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 4</button></a>
<a href="viewNotes.php?dep=2&sem=5"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 5</button></a>
<a href="viewNotes.php?dep=2&sem=6"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 6</button></a>
</div>
<div class="notification-wrapper" style="background-color:lightblue; border: solid 1px; margin-top: 10%; display: none;" id="electrical">
    Electrical:
<a href="viewNotes.php?dep=3&sem=1"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:10%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 1</button></a>
<a href="viewNotes.php?dep=3&sem=2"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 2</button></a>
<a href="viewNotes.php?dep=3&sem=3"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 3</button></a>
<a href="viewNotes.php?dep=3&sem=4"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 4</button></a>
<a href="viewNotes.php?dep=3&sem=5"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 5</button></a>
<a href="viewNotes.php?dep=3&sem=6"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 6</button></a>
</div>
<div class="notification-wrapper" style="background-color:lightblue; border: solid 1px; margin-top: 10%; display: none;" id="civil">
    Civil:
<a href="viewNotes.php?dep=4&sem=1"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:14%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 1</button></a>
<a href="viewNotes.php?dep=4&sem=2"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 2</button></a>
<a href="viewNotes.php?dep=4&sem=3"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 3</button></a>
<a href="viewNotes.php?dep=4&sem=4"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 4</button></a>
<a href="viewNotes.php?dep=4&sem=5"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 5</button></a>
<a href="viewNotes.php?dep=4&sem=6"><button  style="width:20%; padding-top:1%; padding-bottom:1%; margin-left:20%; margin-right:0%; margin-bottom:3%;"onclick="">Semester 6</button></a>
</div>
<script type="text/javascript">
<!--
    function toggleComputer() {
       var e = document.getElementById("computer");
          e.style.display = "block";
        var e = document.getElementById("mechanical");
          e.style.display = "none";
        var e = document.getElementById("electrical");
          e.style.display = "none";
        var e = document.getElementById("civil");
          e.style.display = "none";
    }
    function toggleMechanical() {
       var e = document.getElementById("mechanical");
          e.style.display = "block";
        var e = document.getElementById("computer");
          e.style.display = "none";
        var e = document.getElementById("electrical");
          e.style.display = "none";
        var e = document.getElementById("civil");
          e.style.display = "none";
      }
    function toggleElectrical() {
       var e = document.getElementById("electrical");
          e.style.display = "block";
        var e = document.getElementById("mechanical");
          e.style.display = "none";
        var e = document.getElementById("computer");
          e.style.display = "none";
        var e = document.getElementById("civil");
          e.style.display = "none";
    }
    function toggleCivil() {
       var e = document.getElementById("civil");
          e.style.display = "block";
        var e = document.getElementById("mechanical");
          e.style.display = "none";
        var e = document.getElementById("electrical");
          e.style.display = "none";
        var e = document.getElementById("computer");
          e.style.display = "none";
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