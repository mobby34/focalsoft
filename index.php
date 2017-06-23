<?php
	// include home class
	require_once 'class/page.php';	
		
	// create page instance
	$page = new Page();
	
	// set page title
	$page->SetTitle('We Develop Websites, Online Stores, Corporate Branding And Social Media Marketing');

	// set description of our application
	$page->SetDescription('We build digital solutions for our clients. From building websites, onlines stores, marketing to graphic design.');

	$page->trinity();
?>