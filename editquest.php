<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection2 = new MongoCollection( $db, "quests");
    //print $_POST["desc"];
    $newDesc = $_POST["desc"];
    $newDesc = str_replace("\r\n",'**',$newDesc);
    //print $newDesc;

    $newquest=array('$set'=>array('title' => $_POST["title"], 'xp' => (int)$_POST["xp"],  'due_date' => $_POST["due_date"], 'desc' => $newDesc, 'course_id'=>"DET 210"));
    $collection2->update(array("title" => $_POST["oldTitle"]),$newquest);

    header("Location: http://gamedev.garrettyamada.com/quests.php");
?>