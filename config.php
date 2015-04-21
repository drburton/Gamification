<?php
//ob_start();
//error_reporting(E_ALL);
$m = new MongoClient();
$db = $m->selectDB("gamification_db");
$coll = new MongoCollection( $db, "users");
// $m    = new Mongo();
// $db   = $m->test;
// $coll = $db->users;
//include_once("functions.php");
session_start();
session_register("login")=null;
session_register("password")=null;
session_register("loggedIn")=null;
?>
<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
  	<h1>Hello</h1>
  </body>
<html>