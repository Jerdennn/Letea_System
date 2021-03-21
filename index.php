<?php
// include the config.php
require_once 'resources/config.php';
require_once 'resources/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sales and Inventory</title>
	<link rel="stylesheet" type="text/css" href="public_html/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<div class="img">
			<img src="public_html/img/login.svg">
		</div>
		<div class="login-content">
			<form method="POST" action="resources/libraries/login_process.php">
				<h3 class="title">Le'Tea Sales and inventory Monitoring</h3>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username" >
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name= "password" >
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" name="btn_login" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="public_html/js/main.js"></script>
</body>
</html>
