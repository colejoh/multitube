<?php
	session_start();
?>
<html>
	<head>
		<title>Signup - Multitube</title>
		<link rel="stylesheet" type="text/css" href="global.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,900' rel='stylesheet' type='text/css'>
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
					$email = $_POST['email'];
					$password = $_POST['password'];
					$submit = $_POST['submit'];
					
					//Connecting to dat database
					$con=mysqli_connect("68.178.143.11","multitube","Coleisnumber1!","multitube");
					
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
			<div id="signupformwrapper">
				<form action="signup.php" method="post">
					<input type="text" id="signupemail" placeholder="Email" name="signupemail"><br/>
					<input type="text" id="signupfirst" placeholder="First Name" name="first">
					<input type="text" id="signuplast" placeholder="Last Name" name="last"><br/>
					<input type="password" id="signuppassword" placeholder="Password" name="signuppassword"><br/>
					<input type="password" id="signuppassword" placeholder="Verify Password" name="verify"><br/>
					<input type="submit" id="signupbutton" name="signup" value="Signup">
				</form>
			</div>
			<div id="loginphp">
				<?php
					$signupemail = strip_tags($_POST['signupemail']);
					$firstname = strip_tags($_POST['first']);
					$lastname = strip_tags($_POST['last']);
					$signuppassword = strip_tags($_POST['signuppassword']);
					$verifypassword = $_POST['verify'];
					$signup = strip_tags($_POST['signup']);
					
										
					//Connecting to dat database
					$con=mysqli_connect("68.178.143.11","multitube","Coleisnumber1!","multitube");
					
					//Checing dat connection
					if (mysqli_connect_errno()){echo "There was an error connecting to the database." . mysqli_connect_error();}
					
					if($signup){
						if($verifypassword == $signuppassword) {
							$md5pass = md5($signuppassword);
								$sql = "INSERT INTO `users` (`id`, `email`,`firstname`, `lastname`, `password`) VALUES ('', '$signupemail', '$firstname', '$lastname', '$md5pass')";
							if (!mysqli_query($con,$sql)) {
							  die('Error: ' . mysqli_error($con));
							  }else {
								 $_SESSION['LoggedIn'] = $signupemail;
								 echo "<script type='text/javascript'>window.location ='http://www.colejoh.com/multitube/feed';</script>";
							}
						}else echo("Passwords don't match.");//End check password
					};
				?>
			</div>
		</div>
	</body>
</html>