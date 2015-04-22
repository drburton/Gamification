<?php
ob_start();
//error_reporting(E_ALL);
$m = new MongoClient();
$db = $m->selectDB("gamification_db");
$coll = new MongoCollection( $db, "users");
// $m    = new Mongo();
// $db   = $m->test;
// $coll = $db->users;
include_once("functions.php");
$Session=$_SESSION;
// session_start();
// $_SESSION["login"]="test";
// $_SESSION["password"]="pass";
// $_SESSION["loggedIn"]=False;
?>