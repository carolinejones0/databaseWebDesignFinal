<!DOCTYPE HTML>
<html lang="en">
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content = "Your name">
            <meta name ="description"
                content = "top.php">

            <title>Final Project</title>

            <link rel = "stylesheet"
                href = "css/custom.css?version=<?php print time(); ?>"
                type = "text/css">
            <link rel = "stylesheet" media=" (max-width:800px) "
                href = "css/tablet.css?version=<?php print time(); ?>"
                type = "text/css">
            <link rel = "stylesheet" media=" (max-width:600px) "
                href = "css/phone.css?version=<?php print time(); ?>"
                type = "text/css">
</head>

<?php

include 'lib/constants.php';

include 'header.php';
print PHP_EOL;

include 'nav.php';
print PHP_EOL;

$managers = array('you', 'rerickso', 'jcmcgowa', 'tallembe', 'idavis1'); 
// Set manager variable to false 
$manager = false; 

print ' <body> ';
print '<!-- ***** START OF BODY **** -->';

// Replace 'connect-DB.php'
//include 'connect-DB.php';
require_once(LIB_PATH . 'DataBase.php');

$thisDataBaseReader = new DataBase('aberland_reader', DATABASE_NAME);
$thisDataBaseWriter = new DataBase('aberland_writer', DATABASE_NAME);

$managerLoggedIn = false;
?>

            