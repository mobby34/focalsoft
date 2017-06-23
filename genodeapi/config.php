<?php
	// include db api
	include_once('genode/php/db.php');
	
	// create db instance
	$db = new DB();
	
	// set logins
	$_SESSION['db_username'] = 'focalsoft_admin';
	$_SESSION['db_pwd'] = 'admin_login*100';
	$_SESSION['db_database'] = 'focalsoft_genode';
?>