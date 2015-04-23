<?php
function newUser($login, $name, $password)
// old function--{
// 	global $coll;
// 	$coll->insert(array('login' => $login, 'password' => md5($password)));
// 	return true;
// }
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
function cleanMemberSession($login, $password)
{
	$_SESSION["login"]=$login;
	$_SESSION["password"]=md5($password);
	$_SESSION["loggedIn"]=True;
}
function flushMemberSession()
{
	unset($_SESSION["login"]);
	unset($_SESSION["password"]);
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
?>