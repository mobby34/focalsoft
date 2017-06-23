<?php
	// include home class
	require_once 'class/page.php';	
		
	// create page instance
	$page = new Page();
	
	// set page title
	$page->SetTitle('Focal Product');

	$page->trinity();
?>