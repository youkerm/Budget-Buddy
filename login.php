<?php
session_start();
if ($_SESSION["userID"] > 0) {
	header('Location: '. 'https://ub-hacking-youkerm.c9users.io/index.php');
}
?>

<!DOCTYPE html>
	<head>
		<title>Budget Buddy | Login</title>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />
	</head>
	<body style="overflow:hidden;">
		<div id="mainCol">	
			<div id="title">
				<h1 class="title">Budget Buddy</h1>
				<h3 class="tab">Financial Manager</h3>
				<p class="logo">$</p>
			</div>
		</div>
		
		<div id="loginCol">
			<div id="loginCol_header">
				<div id="header_title">
				<h2>Login</h2>
				<p>Don't have a login? <a href="register.php" class="">Register now.</a></p>
				</div>
			</div>
			<div id="loginCol_container">
				<div id="loginForm">
				<form action="php/login.php" method="post">
					<input class="login" type="text" name="username" class="" value="" placeholder="Username">
					<input class="login" type="password" name="password" class="" value="" placeholder="Password">
					<br>
					<button type="submit">Login</button>
				</form>
				</div>
			</div>
		</div>
	</body>
</html>