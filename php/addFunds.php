<?php

include('database.php');

$addType = $_POST['addType'];
$accType = $_POST['accType'];
$balence = $_POST['balence'];
$accID = $_POST['accID'];

$db = new Database;
$conn = $db->getConn();

if ($addType == 'Expense') {
    $insertExp = "INSERT INTO  `Expense` (`ExpenseID`, `AccountID`, `Catagory`, `Amount`, `Date`)
    VALUES (NULL ,  ?,  ?,  ?,  CURRENT_TIMESTAMP);";
    $query = $conn->prepare($insertExp);
    $query->execute(array($accID, 0, $balence));

} else {
    $insertRev = "INSERT INTO `Revenue` (`Revenue_ID`, `AccountID`, `Revenue_Name`, `Revenue_Amount`, `Revenue_Term`) 
              VALUES (NULL, ?, ?, ?, ?);";
    $query = $conn->prepare($insertRev);
    $query->execute(array($accID, $accType, $balence, 0));
}

?>