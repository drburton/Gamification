<?php
//print("Page Loaded<br/>");

$m = new MongoClient();
$db = $m->selectDB("gamification_db");

$response = "";

if(isset($_GET['action'])){
	$action = $_GET["action"];
	//print($action."<br/>");
	if($action=="changeGrade"){
		//print("Getting Data <br/>");
		$user = $_GET["user"];
		$response=$response."_".$user;
		$quest = $_GET["qId"];
		$response=$response."_".$quest;
		$grade = $_GET["grade"];
		$response=$response."_".$grade;
		//print($response."<br/>");
		changeGrade($user,$quest,(int)$grade);
	}
}
function changeGrade($user,$questId,$grade){
	//print("DB Function <br/>");
	//print($user."_".$questId."_".$grade."<br/>");
    //print_r(array('user_id' => $user, 'quest_id' => $questId));
    //print("<br/>");
    $user_quests = new MongoCollection( $db, "users-quests");
    $cursor = $user_quests->findOne(array('user_id' => $user, 'quest_id' => $questId));
    if($cursor){
    	//print("Updating <br/>");
     	$update=array('$set'=>array('grade' => $grade, 'status' => 'graded'));
		$user_quests->update(array('user_id' => $user, 'quest_id' => $questId),$update);
		//header("Location: profile.php");
		//updateUserExperience($user,$cursor["course_id"]);
    }
}

//function updateUserExperience($user,$course){
	/*$userQuests = $user_quests->find(array('user_id' => $user, 'course_id' => $course));
	$userQuests->fields(array('grade' => true,'_id' => false));
	$expTotal=0;
	foreach ($userQuests as $doc) {
        foreach ($doc as $k => $v) {
        	$expTotal = $expTotal + $v;
        }
	}
	$userCourse = $user_courses->findOne(array('user_id' => $user, 'course_id' => $course));
	$update=array('$set'=>array('xp' => $expTotal));
	$user_courses->update(array('user_id' => $user, 'course_id' => $course),$update);*/
//}



//print('End');
//return response;
?>