<?php

  $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "quests");
    $collection->remove(array('title'=>$_POST["deleteTitle"]));
    $course=$_POST["course"];
    $new = str_replace(" ","_",$course);
	
	header("Location: http://gamedev.garrettyamada.com/quests.php?course=".$new);

?>
