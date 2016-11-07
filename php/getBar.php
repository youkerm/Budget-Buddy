<?php
include('database.php');

$accountID = $_GET['accountID'];

$expenseSQL = "SELECT 'Expenses' AS 'category', CAST(SUM(amount)/(SUM(Revenue_Amount) + SUM(amount)) AS DECIMAL(9,2)) AS 'measure' FROM `Expense`, `Revenue` WHERE Expense.AccountID = 1";
$revenueSQL = "SELECT 'Income' AS 'category', CAST(SUM(Revenue_Amount)/(SUM(Revenue_Amount) + SUM(amount)) AS DECIMAL(9,2)) AS 'measure' FROM `Expense`, `Revenue` WHERE Expense.AccountID = 1";

$resultArray = array();

$db = new Database;
$conn = $db->getConn();

$query = $conn->prepare($expenseSQL);
$query->execute(array($accountID));
$expense = $query->fetch(PDO::FETCH_ASSOC);

$query = $conn->prepare($revenueSQL);
$query->execute(array($accountID));
$revenue = $query->fetch(PDO::FETCH_ASSOC);

$resultArray = array($revenue, $expense);

$json = json_encode($resultArray, JSON_NUMERIC_CHECK);

echo $json;

/*{ group: "All", category: "1", id: "1", measure: 63850.4963 }, 
{ group: "All", category: "2", id: "2", measure: 78258.0845 }, 
{ group: "All", category: "3", id: "3", measure: 60610.2355 }, 
{ group: "All", category: "4", id: "4", measure: 30493.1686 }, 
{ group: "All", category: "5", id: "5", measure: 30493.1686 }, 
{ group: "Expenses", category: "1", id: "1", id: "1", measure: 3182.399 }, 
{ group: "Expenses", category: "2", id: "2", measure: 867.927 }, 
{ group: "Expenses", category: "3", id: "3", measure: 1808.18125 }, 
{ group: "Expenses", category: "4", id: "4", measure: 795.59975 }, 
{ group: "Expenses", category: "5", id: "5", measure: 578.618 }, 
{ group: "Income", category: "1", id: "1", measure: 2227.6793 }, 
{ group: "Income", category: "2", id: "2", measure: 3442.7771 }, 
{ group: "Income", category: "3", id: "3", measure: 303.77445 }, 
{ group: "Income", category: "4", id: "4", measure: 2328.93745 }, 
{ group: "Income", category: "5", id: "5", measure: 1822.6467 }, */




?>