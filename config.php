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
session_start();
$Session=$_SESSION;
// $_SESSION["login"]="test";
// $_SESSION["password"]="pass";
// $_SESSION["loggedIn"]=False;
?>