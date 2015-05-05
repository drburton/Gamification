<?php
    include_once "config.php";
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection2 = new MongoCollection( $db, "users-quests");
    //print $_POST["desc"];
    $newDesc = $_POST["desc"];
    $newDesc = str_replace("\r\n",'~',$newDesc);
    $name=$_SESSION["login"];
    $course=$_POST["course"];
    //print $newDesc;

    $newquest=array('title' => $_POST["title"], 'course_id'=>$_POST["course"], 'user_id'=>$name);
    $collection2->save($newquest);

    header("Location: http://gamedev.garrettyamada.com/courseQuests.php?course=".$_POST["course"]);//Kick user back to quests page after inputting new quest into database
?>