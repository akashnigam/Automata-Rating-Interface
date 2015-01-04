<?php
session_start();
if(isset($_SESSION['username']))
header("Location: give_code_call.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Rater Login Form</title>

<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
</head>

<body>
<form class="box login" method="post" <?php 
	  if(isset($_SESSION['errors']))
	  echo 'style="height:285px;"';
	  ?> action="validuser.php" >
	<fieldset class="boxBody">
	  <label>Username</label>
	  <input type="text" tabindex="1" name="username" required>
	  <label><a href="#" class="rLink" tabindex="5">Forget your password?</a>Password</label>
	  <input type="password" tabindex="2" name="password" required>
	  <?php 
	  if(isset($_SESSION['errors']))
	  echo '<label style="color:red; font-size:97%; ">Either username or password you entered is incorrect</label>';
	  ?>
	</fieldset>
	<footer>
	  <!--label><input type="checkbox" tabindex="3">Keep me logged in</label-->
	  <input type="submit" class="btnLogin" value="Login" tabindex="4">
	</footer>
</form>
<footer id="main">
  <a href="#">Aspiring Minds</a> | <a href="#">Raters Login Page</a>
</footer>
</body>
</html>
