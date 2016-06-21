<?php
    include_once "config.php";
    if(isset($_POST["action"])){
        $m = new MongoClient();
        $db = $m->selectDB("gamification_db");
        $collection2 = new MongoCollection( $db, "users-quests");

        if($_POST["action"]=="drop"){
            echo("Drop");
        }elseif($_POST["action"]=="accept"){
            $newDesc = $_POST["desc"];
            $newDesc = str_replace("\r\n",'~',$newDesc);
            $name=$_SESSION["login"];
            $course=$_POST["course"];
            //print $newDesc;
            $new = str_replace("_"," ",$course);

            $newquest=array('title' => $_POST["title"], 'course_id'=>$new, 'user_id'=>$name);
            $collection2->save($newquest);

            //print("/courseQuests.php?course=".$course);
            header("Location: /courseQuests.php?course=".$course);//Kick user back to quests page after inputting new quest into database
        }else{
            echo("null"); 
        }
    }else{
        echo("Bad Wolf");
    }
    /*
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection2 = new MongoCollection( $db, "users-quests");
    //print $_POST["desc"];
    $newDesc = $_POST["desc"];
    $newDesc = str_replace("\r\n",'~',$newDesc);
    $name=$_SESSION["login"];
    $course=$_POST["course"];
    //print $newDesc;
    $new = str_replace("_"," ",$course);

    $newquest=array('title' => $_POST["title"], 'course_id'=>$new, 'user_id'=>$name);
    $collection2->save($newquest);

    //print("/courseQuests.php?course=".$course);
    header("Location: /courseQuests.php?course=".$course);*/ //Kick user back to quests page after inputting new quest into database
?>