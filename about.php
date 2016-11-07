<?php
session_start();
if ($_SESSION["userID"] <= 0) {
	header('Location: '. 'https://ub-hacking-youkerm.c9users.io/login.php');
}
?>

<!DOCTYPE html>
	<head>
		<title>Budget Buddy | About</title>
		<link rel="stylesheet" href="css/reset.css" type="text/css" />
		<link rel="stylesheet" href="css/main.css" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://d3js.org/d3.v2.js"></script>
	</head>
	<body style="overflow:hidden;">
		<div id="header">
			<div id="header_title">
				<h2>Budget Buddy</h2>
				<p>Hello <font color="#fe921f">
					<?php 
					include('php/database.php');
					session_start();
					$userID = $_SESSION["userID"];
					$db = new Database;
					$conn = $db->getConn();
					
					
					$userSql = 'SELECT FirstN, LastN  FROM User WHERE ID = ?';

					$query = $conn->prepare($userSql);
					$query->execute(array($userID));
					$name = $query->fetch();
					
					echo $name['FirstN'] . " " . $name['LastN'];
					
					?>
				</font></p>
			</div>
			
			<form action="php/logout.php">
				<input class="signout" type="submit" value="Sign Out">
			</form>
		</div>
		
		<div id="container">
			<nav id="primary_nav_wrap">
				<ul>
				  <li><a href="index.php">Dashboard</a></li>
				  <li><a href="accounts.php">Accounts</a>
				    <!--<ul>-->
				    <!--  <li><a href="account_check.php">Checkings Account</a></li>-->
				    <!--  <li><a href="account_save.php">Savings Account</a></li>-->
				    <!--  <li><a href="account_cash.php">Cash Flow</a></li>-->
				    <!--</ul>-->
				  </li>
				  <!--<li><a href="#">Activities</a>-->
				  <!--  <ul>-->
				  <!--    <li><a href="#">Recent Activities</a></li>-->
				  <!--    <li><a href="#">Monthly Overview</a></li>-->
				  <!--    <li><a href="#">Yearly Overview</a></li>-->
				  <!--  </ul>-->
				  <!--</li>-->
				  <li class="current-menu-item"><a href="about.php">About</a></li>
			</nav>
			
			<div id="subContainer">
				<p style="display:inline;color:#fe921f;font-size:32px"/>&nbsp&nbsp&nbsp&nbspF</p><p class="about">orged in the firey undergrounds of Moria, Budget Buddy was a team 
				effort between the many nations of Middle Earth. Team members Anthony Albertina, 
				Gavin Youker, Mitch Youker, Jessica Cespedes, and Greg Stein teamed for one final fight; 
				the budgeting dark recesses of finances once more needed to be brought back to the light. 
				With their expertise in PHP, HTML, MySQL, and several java libraries (represented by
				Rancoores?), the team was able to build all the necessary components 
				in secret.</p><br>
				<p class="about">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFirst, from the kingdoms of man, from a strong vault, the SQL code was 
				run on phpMyadmin, enabling all the smiths to forge a relational database together. 
				Next, in a distant secluded land, in the deepest darkest recesses of Mirkwood, J3 libraries
				were built from the fresh saplings building the strongest graphing techniques known to 
				the elves. Sam and Frodo (Mitch and Gav), with their eternal bond, should probably represent 
				the HTML backbone and CSS carrying the load, who in the darkness, bound this project 
				together. Wait, are we the bad guys in this metaphor?</p>
			</div>
			<br><br><br>
	   	</div>
	</body>
</html>

