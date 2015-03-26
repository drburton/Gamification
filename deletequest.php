<?php

  $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "quests");

    $collection->remove(array('title'=>'something'));

?>
