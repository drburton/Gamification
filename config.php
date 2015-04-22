<?php
//ob_start();
//error_reporting(E_ALL);
$m = new MongoClient();
$db = $m->selectDB("gamification_db");
$coll = new MongoCollection( $db, "users");
// $m    = new Mongo();
// $db   = $m->test;
// $coll = $db->users;
include_once("functions.php");
session_start();
$_SESSION["login"]=null;
$_SESSION["password"]=null;
$_SESSION["loggedIn"]=null;
?>