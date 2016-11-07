<?php
session_start();
session_unset(); 
session_destroy();

header('Location: '. 'https://ub-hacking-youkerm.c9users.io/login.php');
?>