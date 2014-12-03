<?php 
$mysqlHost = "mysql.nith.no";
$dbname = "lobfre13";
$dbUsername = "lobfre13";
$dbPassword = "gruppe3";

$database = new PDO("mysql:host=" . $mysqlHost . ";dbname=". $dbname, $dbUsername, $dbPassword);

?>