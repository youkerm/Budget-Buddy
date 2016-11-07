<?php
session_start();
if ($_SESSION["userID"] > 0) {
	header('Location: '. 'https://ub-hacking-youkerm.c9users.io/');
}
?>

<!DOCTYPE html>
    <head>
        <title>Budget Buddy | Register</title>
        <link rel="stylesheet" href="css/reset.css" type="text/css" />
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <script src="js/main.js"></script>
    </head>
    <body style="overflow:hidden;">
    <div style="overflow:auto; position:absolute; top: 0px; left:0px; right:0px; bottom:0px">
        <div id="header">
            <div id="header_title">
    			<h2>Register</h2>
    			<p>Have an account? <a href="login.php" class="">Login now.</a></p>
			</div>
        </div>
        
        <form action="php/register.php" method="post">
            <div id="container">
                <div id="registerForm_container">
                    <h3 style="color:#000">User Information</h3>
                    <div id="registerForm">
                        <input class="register" type="text" name="first" placeholder="First Name"><br>
                        <input class="register" type="text" name="last" placeholder="Last Name"><br>
                        <input class="register" type="text" name="user" placeholder="Username"><br>
                        <input class="register" type="password" name="pass1" placeholder="Password"><br>
                        <input class="register" type="password" name="pass2" placeholder="Re-enter Password"><br>
                    </div>
                </div>
                
                <div id="registerForm_container">
                    <h3 style="color:#000">Account Information</h3>
                    <div id="registerForm">
                        <input class="register" type="text" name="accName" placeholder="Account Name"><br>
                        <input class="register" type="text" name="accType" list="accType"  placeholder="Checkings"><br>
                        <datalist id="accType">
                            <option value="Checkings">
                            <option value="Savings">
                            <option value="Petty Cash">
                        </datalist>
                        <input class="register" type="number" step="any" name="balence" min="0" placeholder="Current Balance"><br>
                    </div>
                </div>
                
                <div id="registerForm_container">
                    <h3 style="color:#000">Account Information</h3>
                    <div id="registerForm">
                        <input class="register" type="text" name="accName" placeholder="Account Name"><br>
                        <input class="register" type="text" name="accType" list="accType"  placeholder="Savings"><br>
                        <datalist id="accType">
                            <option value="Checkings">
                            <option value="Savings">
                            <option value="Petty Cash">
                        </datalist>
                        <input class="register" type="number" step="any" name="balence" min="0" placeholder="Current Balance"><br>
                    </div>
                </div>
                
                <div id="registerForm_container">
                    <h3 style="color:#000">Account Information</h3>
                    <div id="registerForm">
                        <input class="register" type="text" name="accName" placeholder="Account Name"><br>
                        <input class="register" type="text" name="accType" list="accType"  placeholder="Petty Cash"><br>
                        <datalist id="accType">
                            <option value="Checkings">
                            <option value="Savings">
                            <option value="Petty Cash">
                        </datalist>
                        <input class="register" type="number" step="any" name="balence" min="0" placeholder="Current Balance"><br>
                    </div>
                </div>
                
                <center><button type="submit" class="register">Submit</button></center>
            </form>
        </div>
    </body>
</html>