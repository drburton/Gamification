<?php

		$course=$_POST["course"];
    $new = str_replace(" ","_",$course);
  	$m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "quests");
    $collection->remove(array('title'=>$_POST["deleteTitle"],'course_id'=>$course));
	
	header("Location: /quests.php?course=".$new);

?>
