<?php
	// configuration
	include('../config.php');
	
	// let retrieve details from headers
	$name       = ucwords($_POST['fullname']);
	$email      = $_POST['email'];
	$cell       = $_POST['cell'];
	$package    = $_POST['package'];

	// Insert the contact person
	$results = $db->insert('clients', array('contact_person' => $name,
									        'email' => $email,
									        'contact_number' => $cell,
									        'status' => 'lead'));

	// Fid the id
	$results = $db->fetch('clients', array('email' => $email), 'all');
	$id      = $results[0]['id'];

	// Insert the lead
	$results = $db->insert('leads', array('package' => $package,
									     'owner' => $id));

	if($results){
		// Send email to both client and Focalsoft
		// 			CLIENT
		$recepients = array($email => $name);
		$subject    = ucwords($package).' Package Purchase.';
		$_email = 'noreply@focalsoft.co.za';
		$msg = 
		$name.'<br /><br />
		You have recently made a purchase with Focalsoft. One of our representatives will be in contact with you as soon as possible.
		<br /><br />
		Thanks for choosing Focalsoft for your '.$package.'. Enjoy the rest of your day.
		<br />
		<br />
		Regards<br />
		Focalsoft Sales Department<br />
		<b> <a href="www.focalsoft.co.za"> www.focalsoft.co.za </a> </b>';

		// Send email
		$result = $db->m_SendEmail($recepients, $subject, $msg, $_email, $type='plain',array(), 'Focalsoft');

		//          FOCALSOFT
		$recepients = array(
						'sales@focalsoft.co.za' => 'Sales Department',
        );

		$msg ='
		Hi there<br /><br />
		'.$name.' just made a '.$package.' package purchase with Focalsoft. Please follow up with him or he within the next 5 minutes to close the sale. For the client details, please log in to Green Books.
		<br /><br />
		Have a great day.
		<br />
		<br />
		Regards<br />
		GreenBooks<br />
		<b> <a href="www.greenbooks.co.za"> www.greenbooks.co.za </a> </b>';

		// Send email
		$result = $db->m_SendEmail($recepients, $subject, $msg, $_email, $type='plain',array(), 'Focalsoft');
	}

	// Return to the caller
	echo ( $results )? 1 : 0;
?>