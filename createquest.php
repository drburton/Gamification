<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection2 = new MongoCollection( $db, "quests");

    $newquest=array('title' => $_POST["title"], 'xp' => $_POST["xp"], 'desc' => $_POST["desc"], 'course_id'=> 'DET 210');
    $collection2->save($newquest);

    header("Location: http://gamedev.garrettyamada.com/quests.php");
?>