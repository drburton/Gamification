<?php

	$m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "quests");

	$newquest=array('title' => $_POST["title"], 'xp' => $_POST["xp"],  'due-date' => $_POST["due-date"], 'desc' => $_POST["desc"], 'course_id'=>"DET 210");
	$collection->save($newquest);

?>
