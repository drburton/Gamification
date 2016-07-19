<?php
print("Page Loaded");
$response = "";

if(isset($_GET['action'])){
	$action = $_GET["action"];
	if($action=="changeGrade"){
		$user = $_GET["user"];
		//$response=$response."_".$user;
		$quest = $_GET["qid"];
		//$response+="_"+$quest;
		$grade = $_GET["grade"];
		//$response+="_"+$grade;
		print($response);
		//changeGrade($user,$quest,$grade);
	}
}
function changeGrade($user,$questId,$grade){
	$m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $user_quests = new MongoCollection( $db, "users-quests");
    $cursor = $user_quests->findOne(array('_id' => new MongoId($newProgram)));
	    if($programCursor){
	     	$user=$userCollection->findOne(array('user_id' => $user, 'quest_id' => $quest_id));
	     		//array('$set'=>array(
	     	$update=array('$set'=>array('grade' => $grade, 'status' => 'graded'));
    		$userCollection->update(array('user_id' => $user, 'quest_id' => $quest_id),$update);
    		//header("Location: profile.php");
	    }
}

//return response;
?>