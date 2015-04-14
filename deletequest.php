<?php

  $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "quests");

    $collection->remove(array('title'=>$_POST["deleteTitle"]));
	
	header("Location: http://gamedev.garrettyamada.com/quests.php");

?>
