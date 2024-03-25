<!DOCTYPE HTML>
<html lang="en">
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content = "Your name">
            <meta name ="description"
                content = "top.php">

            <title>FINAL PROJECT</title>

            <link rel = "stylesheet"
                href = "../css/custom.css?version=<?php print time(); ?>"
                type = "text/css">
            <link rel = "stylesheet" media=" (max-width:800px) "
                href = "../css/tablet.css?version=<?php print time(); ?>"
                type = "text/css">
            <link rel = "stylesheet" media=" (max-width:600px) "
                href = "../css/phone.css?version=<?php print time(); ?>"
                type = "text/css">
</head>

<?php
 

print ' <body> ';
print '<!-- ***** START OF BODY **** -->';


include 'header.php';
include '../lib/constants.php';
// include '../connect-DB.php';
require_once('../' . LIB_PATH . 'DataBase.php');

$thisDataBaseReader = new Database('aberland_reader', DATABASE_NAME);
$thisDataBaseWriter = new Database('aberland_writer', DATABASE_NAME);

print PHP_EOL;

include 'nav.php';
print PHP_EOL;

// retrieve UVM netID
// print '<--! Find manager -->';
//$netId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");

// Is that netID in table of admins?
//$managers = array('aberland', 'rerickso', 'jcmcgowa', 'tallembe', 'idavis1');
//$managerLoggedIn = in_array($netId, ..$managers) ? true : false;

/* CREATE TABLE tblManagers (pmkPanagerId varchar(10) primary key);
INSERT INTO tblManagers (pmkManagerId) VALUES ('you'), ('rercikso'), ('tas-netid');
*/
// $sql = 'SELECT pmkManagerId FROM tblManagers';
// print '<p>SQL: ' . $sql;

/*$managers = $thisDataBaseWriter->select($query);

print '<pre>Array'; print_r($managers); print '</pre>';

$managerLoggedIn = false;
foreach($managers as $manager){
    if($manager['pmkManagerId'] == $netId) $managerLoggedIn = true;
}

// Debugging statemnet for manager not logged in
if (!$managerLoggedIn){
    print '<h1>Not Found</h1>';
    print '<h2>The requested URL was not found on this server.</h2>';
    die(); 
}*/

// retrieve UVM netID
$netId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");

// Is that netID in table of admins?
$managers = array('aberland', 'cjones33', 'gfoster1', 'idavis1', 'jcmcgowa', 'rerickso', 'tallembe' );
$managerLoggedIn = in_array($netId, $managers) ? true : false;
print "<p> net id: ".$netId."</p>";
if (!$managerLoggedIn){
    print '<h1>Not Found</h1>';
    print '<h2>The requested URL was not found on this server.</h2>';
    die(); 
}
?>













            