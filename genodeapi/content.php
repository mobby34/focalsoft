<?php
	// include home class
	require_once 'class/page.php';	
		
	// create page instance
	$page = new Page();

	if(isset($_GET['p']))
	{
		// Current fn
		$fn = $_GET['p'];

		$html = $page->ContentKanvas($fn);
	}else
		$html = 'Invalid Gateway';

	// Display
	echo $html;
?>