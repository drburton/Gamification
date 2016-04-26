<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection2 = new MongoCollection( $db, "quests");
    //print $_POST["desc"];
    $newDesc = $_POST["desc"];
    $newDesc = str_replace("\r\n",'~',$newDesc);
    //print $newDesc;
    $course=$_POST["course"];
    $new = str_replace(" ","_",$course);

    $newquest=array('$set'=>array('title' => $_POST["title"], 'xp' => (int)$_POST["xp"],  'due_date' => $_POST["due_date"], 'desc' => $newDesc, 'course_id'=>$course));
    $collection2->update(array("title" => $_POST["oldTitle"]),$newquest);

    header("Location: /quests.php?course=".$new);
?>