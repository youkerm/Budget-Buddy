<?php
include('database.php');

$firstName = $_POST['first'];
$lastName = $_POST['last'];
$user = $_POST['user'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

$accType = $_POST['accType'];
$balence = $_POST['balence'];

$revName = $_POST['revName'];
$revAmount = $_POST['revAmount'];
$duration = $_POST['duration'];

$db = new Database;
$conn = $db->getConn();

$insertUserSQL = 'INSERT INTO  `User` (`ID`, `username`, `password`, `FirstN`, `LastN`)
VALUES (NULL ,  ?,  ?,  ?,  ?);';

$userID = 0;

if (($pass1 == $pass2) && $firstName != "" && $firstName != "" && $lastName != "" &&
    $user != "" && $pass1 != "" && $pass2 != "" && $accType != "" && $balence != "" && 
    $revName != "" && $revAmount != "" && $duration != "") {
        
    $query = $conn->prepare($insertUserSQL);
    $query->execute(array($user, $pass1, $firstName, $lastName));
    $userID = intval($conn->lastInsertId());

    $insertAccSQL = 'INSERT INTO  `Accounts` (`AccountID`, `UserID`, `AccountType`, `Amount`)
    VALUES (NULL ,  ?, ?, ?);';
    
    $insertRevSQL = 'INSERT INTO  `Revenue` (`Revenue_ID`, `AccountID`, `Revenue_Name`, `Revenue_Amount`, `Revenue_Term`)
    VALUES (NULL, ?, ?, ?, ?)';

    

    $accID = 0;
    
    if ($userID > 0) {
        $query = $conn->prepare($insertAccSQL);
        $query->execute(array($userID, $accType, $balence));
        $accID = intval($conn->lastInsertId());
        
        $query = $conn->prepare($insertRevSQL);
        $query->execute(array($accID, $revName, $revAmount, $duration));
        $revID = intval($conn->lastInsertId());
        
        session_start();
        $_SESSION['userID'] = $userID;
        header('Location: '.  'https://ub-hacking-youkerm.c9users.io');
    }
}

?>
