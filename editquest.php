<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection2 = new MongoCollection( $db, "quests");

    $newquest=array('title' => $_POST["title"], 'xp' => $_POST["xp"],  'due_date' => $_POST["due_date"], 'desc' => $_POST["desc"], 'course_id'=>"DET 210");
    $collection2->update(array("title" => $_POST["current"]),$newquest);

    header("Location: http://gamedev.garrettyamada.com/quests.php");
?>