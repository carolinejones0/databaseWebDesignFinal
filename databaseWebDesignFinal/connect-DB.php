<?php
$databaseName = 'ABERLAND_final';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$dbUserName = "aberland_admin"; 
$dbPassword = "RB1lFdEdt4cr";  // as listed in the original email when you create your account
// can reset through uvm web accounts 

print '<!-- Make DB connection -->';
$pdo = new PDO($dsn, $dbUserName, $dbPassword);
if($pdo) print '<!-- Connected -->';
?>
