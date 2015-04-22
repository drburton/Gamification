<?php
function newUser($login, $password)
// old function--{
// 	global $coll;
// 	$coll->insert(array('login' => $login, 'password' => md5($password)));
// 	return true;
// }
{
	global $coll;
	$coll->insert(array('_id' => $login, 'password' => md5($password)));
	return true;
}


function checkPass($login, $password) 
{
	global $coll;
	$res = $coll->findOne(array('login' => $login, 'password' => md5($password)));
	if($res){
		return true;
	}
}
function cleanMemberSession($login, $password)
{
	$_SESSION["login"]=$login;
	$_SESSION["password"]=$password;
	$_SESSION["loggedIn"]=true;
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
	  return true;
	}
	else{
	  return false;
	}
}
?>