<?php

function user_get_logged_user()
{
	global $db, $appuser;

	$appuser = 0;
	if (isset($_COOKIE['app_email']) and strlen($_COOKIE['app_email']) > 0) {
		$items = $db->query("SELECT * FROM users WHERE LOWER(email) = ? and pass= ?", $_COOKIE['app_email'], $_COOKIE['app_pass'])->fetchAll();
		if (count($items) > 0) {
			$appuser = $items[0];
		}
		
	}
	return $appuser;
}

function user_process_login($vars)
{
	global $db;

	$ret['status'] = 0;
	$ret['error'] = '';

	$vars['email'] = trim(strtolower($vars['email']));
	
	if (strlen($ret['error']) == 0 and strlen($vars['email']) == 0) {
		$ret['error'] = "You need to provide an email.";
		return $ret;
	}
	
	if (strlen($ret['error']) == 0 and strlen($vars['pass']) == 0) {
		$ret['error'] = "The password should be filled.";
		return $ret;
	}
	
	if (strlen($ret['error']) > 0) return  $ret;
	
	//search for it in the database ?
	$items = $db->query("SELECT * FROM users WHERE LOWER(email) = ? and pass= ?", $vars['email'], md5($vars['pass']))->fetchAll();
	if (count($items) == 0) {
		$ret['error'] = LANG_INCORRECT_EMAIL_PASSWORD;
		return $ret;
	}
	//For the sake of simplicity, log the user directly by setting their cookies..
	setcookie("app_email", $vars['email'], time() + (3600 * 24), "/");
	setcookie("app_pass", md5($vars['pass']), time() + (3600 * 24), "/");
	if ($vars['email'] == 'admin@gmail.com' ) {
		// User is an admin, set the is_admin session variable to true
		setcookie("is-admin", $vars['email'], time() + (3600 * 24), "/");
		
		// Redirect them to the backend homepage
		header('Location: ../view/admin/index.php');
		
	  }

	$ret['status'] = 1;
	$ret['error'] = '';
	return $ret;
}

function admin_get_data()
{
	global $db;
    $admindata = array();
	
	//search for it in the database ?
	$us = $db->query("SELECT * FROM users ")->fetchAll();
	$items = $db->query("SELECT * FROM items ")->fetchAll();
	$pending_items = $db->query("SELECT * FROM items WHERE completed != true")->fetchAll();
	$completed_items = $db->query("SELECT * FROM items WHERE completed = null")->fetchAll();
	$admindata['users'] = ($us);
	$admindata['items'] = ($items);
	$admindata['completed'] = count($completed_items);
	$admindata['pending'] = count($admindata['items']) - $admindata['completed'];
	return $admindata;
	
	//For the sake of simplicity, log the user directly by setting their cookies..
	

}

function user_process_signup($vars)
{
	global $db;

	$ret['status'] = 0;
	$ret['error'] = '';

	$vars['email'] = trim(strtolower($vars['email']));
	$pattern = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
	$ret['match'] = preg_match($pattern, $vars['email']);
	if (preg_match($pattern, $vars['email']) == 0) {
		$ret['error'] = "Not a valid email";
		return $ret;
	};

	if (strlen($ret['error']) == 0 and strlen($vars['email']) == 0) {
		$ret['error'] = LANG_YOU_NEED_TO_PROVIDE_EMAIL;
		return $ret;
	}
	if (strlen($ret['error']) == 0 and strlen($vars['name']) == 0) {
		$ret['error'] = "You need to type in your name.";
		return $ret;
	}

	if (strlen($ret['error']) == 0 and strlen($vars['pass']) == 0) {
		$ret['error'] = "The password should be filled.";
		return $ret;
	}

	if (strlen($ret['error']) > 0) return  $ret;
	//search for it in the database ?
	$items = $db->query("SELECT * FROM users WHERE LOWER(email) = ?", $vars['email'])->fetchAll();
	if (count($items) > 0) {
		$ret['error'] = "There is already an account with this email address";
		return $ret;
	}
	//Else, there is no users in the db with the same email
	$db->query("INSERT INTO users (name, email, pass) VALUES ( ?, ?, ? )", $vars['name'], $vars['email'], md5($vars['pass']));

	//log the user directly by setting their cookies..
	setcookie("app_email", $vars['email'], time() + (3600 * 24), "/");
	setcookie("app_pass", md5($vars['pass']), time() + (3600 * 24), "/");

	$ret['status'] = 1;
	$ret['error'] = '';
	return $ret;
}

function user_change_email($vars)
{
	global $db;

	if (!isset($_COOKIE['app_email']) and strlen($_COOKIE['app_email']) > 0) {
		$ret["status"] = 0;
		$ret['error'] = 'Not logged in';
		return $ret;
	}

	$new_email = $_POST["new_email"];
	$pattern = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
		
	$new_password = md5($_POST["new_password"]);
	$db->query("UPDATE users SET email = ? , pass=? WHERE LOWER(email) = ?;", $new_email, $new_password,$_COOKIE['app_email']);

	$vars['email'] = $new_email;
	$_COOKIE['app_email'] = $new_email;
	$_COOKIE['app_pass'] = $new_password;

	$ret["status"] = 1;
}
