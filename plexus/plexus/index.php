<?php

include 'init.php';
if(isset($_SESSION['user_id'])){
  header('Location: home.php');
}

?>

<!DOCTYPE html>
<html>
<title>Plexus</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme-blue-grey.css">

<body>

<header class="w3-container w3-theme-d1">
  <img src="images/info.png" alt="infoSrm" height="" width="100px">
  <font size="6">&nbsp; Login to Plexus</font>
</header>

<?php
if(isset($_POST['login']) && !empty($_POST['login'])){
  $email=$_POST['email'];
  $password=$_POST['password'];
  if(!empty($email) or !empty($password)){
    $email=$getFromU->checkInput($email);
    $password=$getFromU->checkInput($password);

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $error="Invalid format";
    }else
    {
      if($getFromU->login($email,$password)===false){
        $error="The email or password is incorrect!";
      }
    }

  }else{
    $error="Please enter username & password";
  }

}
?>

<div class="w3-container w3-card-8" style="margin:10% 30%; background-color: #f2f2f2">
  <form  method="POST" >

<p>
  <label>Email</label>
<input class="w3-input" type="text" name="email" placeholder="Enter email" style="width:100%" />
</p>
<p>
  <label>Password</label>
<input class="w3-input" type="password" name="password" placeholder="Enter password" style="width:100%" />
</p>
<p>
<input type="submit" name="login" class="w3-button w3-section w3-theme-d1 w3-ripple" value="Log in"/>
<a href="signup.php">Sign Up</a>
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
