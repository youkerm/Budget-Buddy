<?php
include('database.php');
$username = $_POST['username'];
$password = $_POST['password'];


$db = new Database;
$conn = $db->getConn();

$loginSQL = 'SELECT id FROM User WHERE username = ? AND password = ?';

$query = $conn->prepare($loginSQL);
$query->execute(array($username, $password));
$userID = intval($query->fetch()['id']);

if ($userID > 0) {
    echo "Success!!";
    session_start();
    $_SESSION['userID'] = $userID;
    header('Location: '. 'https://ub-hacking-youkerm.c9users.io');
} else {
    echo "Failed";
}

?>