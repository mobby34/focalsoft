<?php
	// include db api
	include_once('genode/php/db.php');
	
	// create db instance
	$db = new DB();
	
	// set logins
	$_SESSION['db_username'] = 'root';
	$_SESSION['db_pwd'] = '';
	$_SESSION['db_database'] = 'focalsoft';
?>