<?php

		//==========================================================
		//user login and security functions
		//==========================================================
		function newUser($login, $first_name, $last_name, $security_question, $sec_answer, $password)
		{
			global $coll;
			$coll->insert(array('_id' => $login, 'first_name' => $first_name,'last_name' => $last_name,
			'name'=> $first_name.' '.$last_name, 'security_question' => $security_question, 'sec_answer' => $sec_answer, 
			'password' => md5($password)));
			return true;
		}


		function checkPass($login, $password)
		{
			global $coll;
			$res = $coll->findOne(array('_id' => $login, 'password' => md5($password)));
			if($res){
				return true;
			}
			else{
				return false;
			}
		}

		function updatePassword($login, $password)
		{
			global $coll;
			$res = $coll->findOne(array('_id' => $login));
			if($res){
				$update=array('$set'=>array('password' => md5($password)));
    			$coll->update(array("_id" => $login),$update);
			}
		}

		function cleanMemberSession($login)
		{
			global $coll;
			$name = $coll->findOne(array('_id' => $login), array('name'));
			foreach ($name as $k => $v){
				if($k=='name'){
					$name=$v;
				}
			}
			$_SESSION["login"]=$login;
			$_SESSION["name"]=$name;
			$_SESSION["loggedIn"]=True;
		}

		function flushMemberSession()
		{
			unset($_SESSION["login"]);
			unset($_SESSION["name"]);
			unset($_SESSION["loggedIn"]);
			session_destroy();
			return true;
		}

		function loggedIn()
		{
			if($_SESSION['loggedIn']==true){
			  return True;
			}
			else{
			  return False;
			}
		}
		//==========================================================
		//end user login and security functions
		//==========================================================

		//==========================================================
		//dictate a function to use based on form input
		//==========================================================

		if(isset($_POST["form"])){
			$methodName = $_POST["form"];
			switch($methodName){
				case "changeProgram":
					changeProgram($_POST["login"], $_POST["program"]);
					break;
				default:
					return;
		}
	}

	//==========================================================
	//change of profile values
	//==========================================================

	function changeProgram($login, $newProgram){
		print($newProgram);
		$m = new MongoClient();
	    $db = $m->selectDB("gamification_db");
	    $programCollection = new MongoCollection( $db, "programs");
	    $userCollection = new MongoCollection( $db, "users");

	    $programCursor = $programCollection->findOne(array('_id' => new MongoId($newProgram)));
	    if($programCursor){
	     	$user=$userCollection->findOne(array('_id' => $login));
	     		//array('$set'=>array(
	     	$update=array('$set'=>array('program_id' => new MongoId($newProgram)));
    		$userCollection->update(array("_id" => $login),$update);
    		header("Location: profile.php");
	    }
	}

?>
