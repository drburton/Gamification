<?php

		//==========================================================
		//user login and security functions
		//==========================================================
		function newUser($login, $name, $password)
		{
			global $coll;
			$coll->insert(array('_id' => $login, 'name'=> $name, 'password' => md5($password)));
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
		$m = new MongoClient();
	    $db = $m->selectDB("gamification_db");
	    $programCollection = new MongoCollection( $db, "programs");
	    $userCollection = new MongoCollection( $db, "users");

	    $programCursor = $programCollection->find(array('_id' => $newProgram));
	     if($programCursor->count()>0){
	     	$user=$userCollection->findOne(array('_id' => $login));
	     		//array('$set'=>array(
	     	header("Location: dashboard.php");
	     }
	}

?>
