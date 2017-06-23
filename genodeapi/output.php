<?php
	// include home class
	require_once 'class/page.php';	
		
	// create page instance
	$page = new Page();
	
	echo $page->cmt('Keywords').'$keywords = \'programming, Python, JAVA, nerd, code\';<br /><br />height: 310px;$keywords = \'programming, Python, JAVA, nerd, code\';<br /><br />height: 310px;$keywords = \'programming, Python, JAVA, nerd, code\';<br /><br />height: 310px;$keywords = \'programming, Python, JAVA, nerd, code\';<br /><br />height: 310px;$keywords = \'programming, Python, JAVA, nerd, code\';<br /><br />height: 310px;'.$page->cmt('Set Keywords').'$this->click($keywords);';
?>