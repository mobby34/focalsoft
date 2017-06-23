<?php
	// Include config file
	include('../config.php');

	// Table
	$table = 'api_fn';

	// OC - Open Close state
	// Retrieve the important info
	$fn = $_POST['id'];

	// Find the current OC state of the tab
	$data = $db->fetch($table, array('fn' => $fn), 'all');
	
	// Current OC
	$id  = $data[0]['id'];
	$coc = $data[0]['oc'];

	// Flip
	$oc = ($coc == 1)? 0 : 1;

	// Update
	$result = $db->update($table, array('oc' => $oc), array('id' => $id));

	// Response
	return $id;
?>