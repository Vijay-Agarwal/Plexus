<?php
include 'init.php';
?>
<!DOCTYPE html>
<html>
<title>Plexus</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme-blue-grey.css">
<link rel="icon" 
  type="image/png" 
  href="images/logo.png">
<body>

<header class="w3-container w3-theme-d1">
  <img src="images/info.png" alt="infoSrm" height="" width="100px">
  <font size="6">&nbsp; SignUp to Plexus</font>
</header>


<?php 
if(isset($_POST['signup'])&& !empty($_POST['signup'])) {
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $mobile=$_POST['mobile'];
  $dob=$_POST['dob'];
  $error='';
  if(empty($name) or empty($email) or empty($dob) or empty($password) or empty($dob)){
    $error='All fields are required';
  }else{
    $email=$getFromU->checkInput($email);
    $name=$getFromU->checkInput($name);
    $password=$getFromU->checkInput($password);
    if(!filter_var($email)){
      $error='Invalid email format';
    }else if(strlen($name)>20){
      $error='Name must upto 20 characters';
    }else if(strlen($password)>32){
      $error="password must be upto 32 characters";
    }else if(strlen($password)<5){
      $error="password too short";
    }else{
      if($getFromU->checkEmail($email)===true){
        $error='Email is alraedy in use';
      }else{
        $getFromU->register($name,$email,$password,$mobile,$dob);
        header('Location: home.php');
      }
    }
  }
}

?>
<div class="w3-container w3-card-8" style="margin:10% 30%; background-color: #f2f2f2">
<form  method="POST" >

<p>
  <label>Name</label>
<input class="w3-input" type="text" name="name" placeholder="Enter your name" style="width:100%" >
</p>
<p>
  <label>Email</label>
<input class="w3-input" type="text" name="email" placeholder="Enter your email" style="width:100%" >
</p>
<p>
  <label>Password</label>
<input class="w3-input" type="password" name="password" placeholder="Enter your password" style="width:100%" >
</p>
<p>
  <label>Mobile</label>
<input class="w3-input" type="text" name="mobile" placeholder="Enter your number" style="width:100%" >
</p>
<p>
  <label>Date of Birth</label>
<input class="w3-input" type="Date" name="dob"  style="width:100%" >
</p>
<p>
<input type="submit" name="signup" class="w3-button w3-section w3-theme-d1 w3-ripple" Sign Up>
<a href="index.php">Login</a>
<?php
if(isset($error)){
  echo '<div class="w3-red">'.$error.'</div>';
}
?>
</p>

</form>

</div>



</body>
<style type="text/css">
  body {
    background-image: url("images/bg.jpg");
    background-repeat: no-repeat;
    background-position: right top;
    background-attachment: fixed;
}
</style>
</html> 
