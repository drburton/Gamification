<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    $collection2 = new MongoCollection( $db, "quests");
    $course=$_GET["course"];
    console.log($course);

    header("Location: http://gamedev.garrettyamada.com/quests.php");
?>