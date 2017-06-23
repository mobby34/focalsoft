<?php
	// Include config file
	include('../config.php');

	// Declarations
	$result = 0;
	$table = 'api_fn';

	// Available languages
	$languages = array('php', 'css', 'js');

	// Retrieve the important info
	$id  = addslashes($_POST['id']);

	// Look fo the set language and update it
	foreach($languages as $lan) {
	    // SQL Key
	    $sqlkey = $lan.'_code';

	    if(isset($_POST[$sqlkey]))
	    {
	    	// CLAN : Current LANguage
			$clan = htmlentities( nl2br2($_POST[$sqlkey]) );

			// Put comment
			$clan = str_replace('/*', '<div class="comment">/*', $clan);
			$clan = str_replace('*/', '*/</div>', $clan);

			// Next line
			//$clan = preg_replace('~\r\n?~', "\n", $clan);
			//$clan = str_replace("\r\n\r\n", '<br /><br />', $clan);
			//$clan = str_replace("\n\n", '<br /><br />', $clan);*/

			// Find the current OC state of the tab
			$result = $db->update($table, array($sqlkey => $clan), 
									      array('id' => $id));

			// Unset so we don't add it once again
			if($result)
				unset($_POST[$sqlkey]);

			// Break, you update once per session
			break;
	    }	
	}

	// Return to the caller
	echo $result;

	// exit
	exit;

	function nl2br2($string) { 
		return preg_replace('/\R/u', '<br/>', $string);
	} 
?>