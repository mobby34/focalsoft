<?php
	// configuration
	include('../config.php');
	
	// let retrieve details from headers
	$name       = $_POST['fullname'];
	$email      = $_POST['email'];
	$cell       = $_POST['cell'];
	$company    = $_POST['company'];
	$service    = $_POST['service_type'];
	$date       = time();

	// Check if we have the current client
	$count      = $db->fetch('clients', array('email' => $email), 'count');
	

	if($count == 0){
		// Insert the contact person
		$results = $db->insert('clients', array('name' => $company,
												'contact_person' => $name,
												'contact_number' => $cell,
										        'email' => $email,
										        'status' => 'lead'));
	}

	// Fid the owner
	$results = $db->fetch('clients', array('email' => $email), 'all');
	$owner   = $results[0]['id'];

	// Add new acccount in the database
	$smt = $db->pdo->prepare("INSERT INTO `leads` (service_type, date, owner) VALUES (?, ?, ?)");
	$smt->bindParam(1, $service);
	$smt->bindParam(2, $date);
	$smt->bindParam(3, $owner);

	if($smt->execute())
	{
		// Send email to both client and Focalsoft
		// 			CLIENT
		$recepients = array($email => $name);
		$subject    = ucwords($service).' Enquiry';
		$_email = 'noreply@focalsoft.co.za';
		$msg = 
		$name.'<br /><br />
		You have recently made a service enquiry with Focalsoft. One of our representatives will be in contact with you as soon as possible.
		<br /><br />
		Have a great day.
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
		Admin<br /><br />
		'.$name.' just made a service enquiry for '.$service.' with Focalsoft. Please follow up with him or her within the next 5 minutes to close the sale. For the client details, please log in to Green Books.
		<br /><br />
		Have a great day.
		<br />
		<br />
		Regards<br />
		GreenBooks<br />
		<b> <a href="www.greenbooks.co.za"> www.greenbooks.co.za </a> </b>';

		// Send email
		$result = $db->m_SendEmail($recepients, $subject, $msg, $_email, $type='plain',array(), 'Focalsoft');
	}else
		$result = 0;

	// return to the caller
	echo $result;
?>