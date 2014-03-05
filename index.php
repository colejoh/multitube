<?php
session_start();
if ($_SESSION['LoggedIn']){
    echo "<script type='text/javascript'>window.location ='http://www.colejoh.com/multitube/feed';</script>";
    };
?>
<html>
	<head>
		<title>Multitube</title>
		<link rel="stylesheet" type="text/css" href="global.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,900|Bree+Serif' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.js"></script>
		<script type="text/javascript" src="http://colejoh.com/multitube/scripts/su.js"></script>
	</head>
	<body>
		<div id="signup">
			<h3>Signup</h3>
		</div>
		<div id="darken">
		</div>
		<header>
			<h1>
				MultiTube
			</h1>
		</header>
		<div id="login">
			<form action="index.php" method="post">
				<input type="text" placeholder="Email" name="email">
				<input type="password" placeholder="Password" name="password">
				<input type="submit" name="submit" value="Login">
			</form>
			<div id="loginphp">
				<?php
					$directemail = $_POST['email'];
					$directpassword = $_POST['password'];
					
					$stripemail = strip_tags($directemail);
					$strippassword = strip_tags($dbpassword);
					
					$loginmd5pass = md5($strippassword);
					
					$email = $_POST['email'];
					$password = md5($_POST['password']);
					$submit = strip_tags($_POST['submit']);
					
					//Connecting to dat database
					$con=mysqli_connect("68.178.143.11","multitube","Number1pass!","multitube");
					
					//Checing dat connection
					if (mysqli_connect_errno()){echo "There was an error connecting to the database." . mysqli_connect_error();}
					
					if($submit){
						
						$result = mysqli_query($con,"SELECT `password` FROM `users` WHERE '$email'=`email`");
						
						while($row = mysqli_fetch_array($result)){
						  $dbpassword = $row['password'];
						  
						  	if($dbpassword == $password){
								  $_SESSION['LoggedIn'] = $email;
								  echo "<script type='text/javascript'>window.location ='http://www.colejoh.com/multitube/feed';</script>";
							}else
								  echo "Incorrect Username/Password Combination";
						}
					};
				?>
			</div>
		</div>
		<div id="grabber">
			<h2>Create multiple feeds of your favorite youtube channels.</h2>
			<a href="signup.php">
				<div id="signupbutton">
					Signup
				</div>
			</a>
			<div id="screen">
			</div>
		</div>
		<div id="homemulticount">
			<!--There are currently ___ multis.-->
		</div>
	</body>
</html>