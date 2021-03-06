<?php
session_start();
if ($_SESSION["userID"] <= 0) {
	header('Location: '. 'https://ub-hacking-youkerm.c9users.io/login.php');
}
?>

<!DOCTYPE html>
	<head>
		<title>Budget Buddy | Accounts</title>
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
				  <li class="current-menu-item"><a href="accounts.php">Accounts</a>
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
				  <li><a href="about.php">About</a></li>
			</nav>
			
			<div id="subContainer">
	            <h3 style="color:#000">Add Expense/Revenue</h3>
	            <div id="registerForm">
	            	<form action="php/addFunds.php" method="POST">
		                <input class="register" type="text" name="addType" list="addType" placeholder="Expense/Revenue"><br>
		                <datalist id="addType">
		                    <option value="Expense">
		                    <option value="Revenue">
		                </datalist>
		                <input class="register" type="text" name="accType" list="accType"  placeholder="Account"><br>
		                <datalist id="accType">
		                <?php
							
							session_start();
							
							$db = new Database;
							$conn = $db->getConn();
							
							$accSQL = "SELECT AccountType FROM Accounts WHERE userID = ?";
							
							$query = $conn->prepare($accSQL);
							$query->execute(array($_SESSION["userID"]));
							while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	        					echo "<option value='" . $row['AccountType'] . "'>";
	    					}
							
		                ?>
		                </datalist>
		                <input class="register" type="number" step="any" name="balence" min="0" placeholder="Amount"><br>
		        	</form>
	            </div>
	            	<center><button type="submit" class="register">Submit</button></center>
            </div>

            <br><br><br><br><br>
            <br><br><br><br><br>
			
	   	</div>
	</body>
</html>

