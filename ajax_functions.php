<?php
print("Page Loaded<br/>");
$response = "";

if(isset($_GET['action'])){
	$action = $_GET["action"];
	print($action."<br/>");
	if($action=="changeGrade"){
		print("Getting Data <br/>");
		$user = $_GET["user"];
		$response=$response."_".$user;
		$quest = $_GET["qId"];
		$response=$response."_".$quest;
		$grade = $_GET["grade"];
		$response=$response."_".$grade;
		print($response."<br/>");
		changeGrade($user,$quest,$grade);
	}
}
function changeGrade($user,$questId,$grade){
	print("DB Function <br/>");
	print($user."_".$questId."_".$grade."<br/>");
	$m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $user_quests = new MongoCollection( $db, "users-quests");
    print(array('user_id' => $user, 'quest_id' => $quest_id)."<br/>");
    $cursor = $user_quests->findOne(array('user_id' => $user, 'quest_id' => $quest_id));
    if($cursor){
    	print("Updating <br/>");
     	$update=array('$set'=>array('grade' => $grade, 'status' => 'graded'));
		$user_quests->update(array('user_id' => $user, 'quest_id' => $quest_id),$update);
		//header("Location: profile.php");
    }
}
print('End');
//return response;
?>