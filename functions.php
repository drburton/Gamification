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
function cleanMemberSession($login)
{
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
?>