<?php
ob_start();

$m = new MongoClient(); //Start MongoDB Driver
$db = $m->selectDB("gamification_db"); //Connect to database
$coll = new MongoCollection( $db, "users"); //Connect to specific collection

include_once("functions.php"); //Include public login-related functions
session_start(); //Start the session

?>
