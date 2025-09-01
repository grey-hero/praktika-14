<?
session_start(); 

function getUsersList(){
	$users = [];

	if (file_exists('users.txt')) {
		$lines = file('users.txt', FILE_IGNORE_NEW_LINES);

		foreach ($lines as $line) {
			$parts = explode('|', $line);
			if (count($parts) >= 2) {
				$users[] = [
					'login' => $parts[0],
					'hashpass' => $parts[1]
				];
			}
		}
	}
	return $users;
}

function existsUser($login){

	if (file_exists('users.txt')) {
		$lines = file('users.txt', FILE_IGNORE_NEW_LINES);

		foreach ($lines as $line) {
			$parts = explode('|', $line);
			if ($login == $parts[0]) {
				return true;
			}
		}
		return false;
	}
	return false;
}

function checkPassword($login, $password){
	$userlist = getUsersList();
	foreach ($userlist as $user) {
		if ($user['login'] == $login && $user['hashpass'] == sha1($password)) {
			$_SESSION['login'] = $login;
			$_SESSION['auth'] = true; 
			$_SESSION['logindate'] = date('Y-m-d H:i:s');
			return true;
		}
	}
	$_SESSION['login'] = '';
	$_SESSION['auth'] = false; 
	return false;
}

function getCurrentUser(){
	if($_SESSION['login'] === ''){
		return null;
	}
	return $_SESSION['login'];
}

?>