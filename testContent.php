<?php
    if (!loggedIn()){
        header("Location: /index.php");
    }
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    include_once "testDash.php";
?>
