<?php
	/**
	  *  @note [USER-ENTRANCE] : login.php
	  *                        : insert-user-account.php
	  *
	  *  @ CASE-SENSIVITY      : We store values in any case lower or high, but for 
	  *						   : comparison, (code logic) we put them to lowercase
	  *						   : refer to login.php
	  */
	class DB
	{     
		public $cCell,
		       $cEmail,
			   $conn;
			      
		/**
		  * Current client of the project
		  */
		public $client;

		/**
		  * Clients domain
		  */
		public $domain;

		/**
		  * This array lists all possible JSON errors 
		  */
		protected static $_json_error = array(
			JSON_ERROR_NONE => 'No error has occurred',
			JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
			JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON',
			JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
			JSON_ERROR_SYNTAX => 'Syntax error',
			JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
		);
		
		public function __construct()
		{
			// start session head
			@session_start();
			
			// add config script
			@include_once('config.php');
			
			// make connection if details are set
			if(isset($_SESSION['db_username']) && isset($_SESSION['db_pwd']) && isset($_SESSION['db_database']))
				$this->config($_SESSION['db_username'], $_SESSION['db_pwd'], $_SESSION['db_database']);
		}
			   
		/**
		 * This function create server and database settings. It makes sure our application
		 * is connected to the server then the database(if available). It accepts all 
		 * neccessary information to make a secure connection
		 *
		 * @param $username, $password, $database, $host
		 */
		public function config($username, $password, $database, $host = 'localhost')
		{                       
			try{
                
				// create connection 
				$this->pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

				// Green Books connection 
				//$this->gb = new PDO("mysql:host=$host;dbname=green_books", $username, $password);
									  
				// set the PDO error mode to exception
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//$this->gb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				echo "Connection failed: ".$e->getMessage();
			}
		}
		
		/**
		 * This function encodes any given JSON data
		 *
		 * @param $value, $options
		 */
		public static function encode($value, $options = 0){
			$result = json_encode($value, $options);
			
			if($result){ 
				return $result;
			}else{
				return static::$_json_error[json_last_error()];
			}
		}

		/**
		 * This function decodes any given JSON data
		 *
		 * @param $value, $assoc
		 */
		public static function decode($value, $assoc = false){
			$result = json_decode($value, $options);
			
			if($result){ 
				return $result;
			}else{
				return static::$_json_error[json_last_error()];
			}
		}

		/**
		 * This function fetch all required data from the database. It gives us
		 * an option to filter data by any choosen filter we might want to use.
		 */
		public function fetch($table, $cond, $search='all', $ref='id', $dir='ASC', $isGB=false)
		{	
			try{
				// form SQL condition
				$condition = $this->SQLCondition($cond);
				
				// prepare and execute given query
				$sql = "SELECT * FROM `$table` $condition ORDER BY $ref $dir";
				$__smt = ($isGB == true)? $this->gb->prepare($sql) : $this->pdo->prepare($sql);
				
				// make the 'smt' is executed
				if( $__smt->execute() )
				{
					if($search == 'count'){
						$rawData = 0;
						while($row = $__smt->fetch()) $rawData++;

					}else if($search == 'all'){
						$rawData = $__smt->fetchAll(PDO::FETCH_ASSOC);
						
					}else{
						// initiate 'rawData'
						$rawData = array();
						$i = 0;

						// loop
						while($row = $__smt->fetch())
						{
							if(is_array($search)){

								// loop through each column
								foreach($search as $column)
									$rawData[$i][$column] = $row[$column];
								
							}else
								$rawData[$i][$search] = $row[$search];
							
							// increment '$i'
							$i++;
						}
					}
					return $rawData;
					
				}else
					return $__smt->errorInfo();
				
			}catch( PDOException $ex){
				return $ex->getMessage();
			}
		}
		
		/**
		 * This function delete database row based on what is given to it
		 */
		public function delete($table, $id)
		{	
			try
			{	
				// prepare and execute given query
				$__smt = $this->pdo->prepare("DELETE FROM `$table` WHERE id=:rowId");
				$__smt->bindParam(':rowId', $id);

				return ($__smt->execute())? 1 : $__smt->errorInfo();
				
			}catch( PDOException $ex)
			{
				return $ex->getMessage();
			}
		}

		/**
		 * This function update database row based on what is given to it
		 */
		public function update($table, $data, $cond)
		{	
			try
			{
				// initiate
				$statement = false;
				$dataCount = count($data);
			
				// check if we have a data or not
				$j = 0;
				if($dataCount >= 0)
				{
					// loop values to be updated
					foreach( $data as $column => $value )
					{	
						// stringify value
						$value = $this->StringifySQL($value);
						
						$statement .= "$column = $value";
						
						// add column if we have more than one column and value
						if($dataCount > 0 && $j < $dataCount - 1)
						{ 
							$statement .= ", ";
							$j++;
						}
					}
				}
				
				// form SQL condition
				$condition = $this->SQLCondition($cond);
				
				// prepare and execute given query
				$__smt = $this->pdo->prepare("UPDATE `$table` SET $statement $condition");
				return ($__smt->execute())? 1 : $__smt->errorInfo();
				
			}catch( PDOException $ex)
			{
				return $ex->getMessage();
			}
		}

		/**
		 * This function insert given data to the database. It can insert multiple
		 * rows or a single row.
		 */
		public function insert($table, $data)
		{				
			// initiate
			$dataCount = count($data);

			// check if the given data is a multidimensional data
			if(@is_array($data[0]))
			{
				// keep track of how many rows where inserted
				$count = 0;
				for($j = 0; $j < $dataCount; $j++)
				{
					// loop each row of data
					if( $this->insertRow($table, $data[$j]) == 1 ){ $count++; }
				}
				return $count;
				
			}else{
				return $this->insertRow($table, $data);
			}
		}
			/**
			 * This function insert a single row to the database
			 */
			public function insertRow($table, $data)
			{
				try
				{
					// initiate
					$columns = $values = false;
					$i = 0;
					$dataCount = count($data);
						
					foreach( $data as $column => $value )
					{
						$columns .= $column;
						$values .= $this->StringifySQL($value);
						
						// add column if we have more than one column and value
						if($dataCount > 0 && $i < $dataCount - 1)
						{ 
							$columns .= ", ";
							$values .= ", ";
							$i++;
						}
					}

					// prepare and execute given query
					$__smt = $this->pdo->prepare("INSERT INTO `$table` ($columns) VALUES($values)");
					return ($__smt->execute())? 1 : 0;
					
				}catch( PDOException $ex)
				{
					return $ex->getMessage();
				}
			}

		/**
		 * This is a basic function that makes sure that our data is stringified as we put
		 * it an SQL statement
		 *
		 * @param $txt
		 */
		public function StringifySQL($txt)
		{
			if(is_string($txt)) $txt = "'".$txt."'";
				
			return $txt;
		}	

		/**
		 * This is a very useful function. It create an SQL condition based on
		 * what is passed to it.
		 *
		 * @param $cond
		 */
		public function SQLCondition($cond)
		{
			if(count($cond) >= 0)
			{
				// start a SQL condition
				$condition = "WHERE ";
				
				// loop each condition given
				$i = 0;				
				foreach( $cond as $column => $data )
				{			
					// BY default, statement will be joined by 'AND'
					$joint = 'AND';
					
					// check if there is more data hidden
					if(is_array($data))
					{
						// retrieve data
						$operator = $data[0];
						$value = $data[1];
						
						if($operator == 'like'){ $value = $data[1].'%'; }
						
						// check if third parameter is set
						if(isset($data[2])){ $joint = $data[2]; }
						
					}else{
						$value = $data;
						$operator = '=';
					}

					// stringify value
					$value = $this->StringifySQL($value);
					
					// add condition
					$condition .= "$column $operator $value";
					
					// add column if we have more than one column and value
					if(count($cond) > 1 && $i < count($cond) - 1)
					{ 
						$condition .= " $joint ";
						$i++;
					}
				}
				
				return $condition;
			}else
			{
				return false;
			}
		}
		
		/**
		 * This functions create configuration for sending high-level
		 * emails using the ever-famous PHPMailer API
		 *
		 * @param $senderName, $senderEmail, $subject
		 */
		public function m_config($senderName, $senderEmail, $subject)
		{
			// SMTP needs accurate times, and the PHP time zone MUST be set
			date_default_timezone_set('Etc/UTC');
			
			// include PHPMailer Lib
			$api = '../genode/PHPMailer/PHPMailerAutoload.php';

			// include core
			require_once( (is_file($api))? $api : ('../'.$api) );
			
			// create PHPMailer instance
			$mail = new PHPMailer();
			
			// SMTP settings
			$mail->isSMTP();
			
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 2;
			
			// get the hoster email
			$hosterMail = 'sender@greenbooks.co.za';
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			// set "mailed-by"
			$host = $_SERVER["HTTP_HOST"];
			$mail->Host = $host;
			
			//Set the SMTP port number - likely to be 25, 465 or 587
			$mail->Port = 25;
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
		
			// Set PHPMailer to use the m_SendEmail transport
			$mail->isSendmail();
		
			// Set Reply to
			$mail->AddReplyTo($senderEmail, $senderName);

			// Set email headers
			$mail->SetFrom($hosterMail, 'Green Books');
			
			if(strlen($senderEmail) > 0)
			{
				// fetch user's initials with last name
				$mail->addReplyTo($senderEmail, $senderName);
			}
			
			// Set Subject of the mail
			$mail->Subject  = $subject;

			// choose appropiate email format (plain or html)
			$mail->isHTML(true);
			
			return $mail;
		}
			/**
			 * This functions send an email based on what we have passed to it
			 *
			 * @param $recipients, $subject, $msg, $senderEmail='', $type='plain', $attachments=array()
			 */
			public function m_SendEmail($recipients, $subject, $msg, $senderEmail='', $type='plain', $attachments=array(), $_hoster='Hoster')
			{
				// mail configurations
				$mail = $this->m_config($_hoster, $senderEmail, $subject);
				
				// let form a message
				if(!is_array($msg))
					$mail->Body = $this->m_chooseTheme($type, $subject, $msg, $senderEmail);
				
				$mailCount = 0;
				$i = 0;
				while(list($recipient_email, $recipient_name) = each($recipients))
				{
					$mail->addAddress($recipient_email, $recipient_name);
					
					// add a specific message for each user
					if(is_array($msg)){
						if(is_array($subject))
							$mail->Body = $this->m_chooseTheme($type, $subject[$i], $msg[$i], $recipient_email);
						else
							$mail->Body = $this->m_chooseTheme($type, $subject, $msg[$i], $recipient_email);
					}
					
					// Add specific subject
					if(is_array($subject))
						$mail->Subject  = $subject[$i];
					
					// if attachements were passed then attach them, DUH!
					if(count($attachments) > 0)
					{
						while(list($display_name, $name) = each($attachments))
							$mail->addAttachment($name, $display_name);
					}
					
					// send mail and return to the caller
					if($mail->send()) $mailCount++;
					
					// Clear all addresses and attachments for next loop
					$mail->clearAddresses();
					$mail->clearAttachments();
					
					// increment i
					$i++;
				}
				
				// send mail and return to the caller
				return ($mailCount == count($recipients))? 1 : 0;
			}
			
			/**
			 * This functions send bulk of emails based on what we have passed to it
			 *
			 * @param $senderName, $senderEmail, $subject, $message, $mailType='default', $start='', $end=''
			 */
			public function m_SendBulkEmails($senderName, $senderEmail, $subject, $message, $mailType='default', $start='', $end='')
			{
				// create phpMailer instance and make configurations
				$mail = $this->m_config($senderName, $senderEmail, $subject);
				
				// initiate recepients array
				$messages   = $recipients = array();
				$emailCount = 0;

				// select all users
				$result     = $this->pdo->query("SELECT * FROM `personal_details` WHERE id  BETWEEN $start AND $end");

				// retrieve user details
				foreach($result as $row)
				{
					// get the email
					$email       = strtolower($row['email']);
					$firstname   = $row['firstname'];
					$lastname    = $row['surname'];
					$fullname    = ucwords($firstname.' '.$lastname);
					$name        = ucwords($this->getFirstname($firstname));
					$name        = (strlen($name))? $name : 'User';
					
					// get the email
					$email       = strtolower($email);
					
					// if the email is valid add message or not
					if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false)
					{
						// check if we havent sent the email already
						if($this->fetch('sent_emails', array('email' => $email), 'count') == 0)
						{
							// add user email and name
							$mail->addAddress($email, $fullname);
							
							// button
							$button = array('Visit Createfile', 'http://www.createfile.co.za');
							
							// form message and add it to phpMailer
							$msg = "Dear ".$name."<p>".$message;
							$mail->msgHTML($this->m_DefaultTheme($subject, $msg, $email, $button, True));
							
							if ($mail->send()){
								// increase count
								$emailCount++;
								
								// sent into sent emails
								$this->insert('sent_emails', 'email', $email);
							}
							// Clear all addresses for next loop
							$mail->clearAddresses();
						}
						
					}else{
						// store invalid emails for later considerations
						$this->insert('invalid_emails', 'email', $email);
					}
				}
				return $emailCount.' emails were sent out of '. ($end - $start);
			}
			
			/**
			 * This function allows us to choose the appropiate theme for our email
			 */
			public function m_chooseTheme($type, $subject, $msg, $email)
			{
				if($type == 'plain')
					$messageHTML = $this->m_DefaultTheme($subject, $msg, $email);
				else
					$messageHTML = $type;
					
				// return to the caller
				return $messageHTML;
			}
			
			/**
			 * This function allows users or failed scripts to send a an 
			 * email to the developer an instant response.
			 *
			 * @param $error, $script, $fn, $email
			 */
			public function m_EmailDeveloper($error, $script, $fn, $email)
			{
				// get current time and date
				$time          = date("l jS \of F Y h:i:s A");

				// subject of the mail
				$subject       = 'ALERT!! ERROR: '.$error.' Reached!';
				
				// form message
				$message       = '<b>Error</b>: '.$error.
								 '<b>Script</b>: '.$script.
								 '<b>Function</b>: <'.$fn.'>'.
								 '<b>User Email</b>: '.$email.
								 '<b>Time</b>: '.$time;

				$developers = array('creaminks@gmail.com' => 'PN Khumalo');
				return $this->m_SendEmail($developers, $subject, $message, 'plain');
			}
			
			/**
			 * This function is responsible for building a default mail
			 * template. It allows us to add a button by the end of the mail.
			 *
			 * @param $title, $msg, $email, $button, $signiture
			 */
			public function m_DefaultTheme($title, $msg, $email, $button="", $signiture="")
			{
				
				return $msg;
			}

			/**
			 * This function adds a signature at the end of the email
			 *
			 * @param $signature
			 */
			public function m_signature($signature)
			{
				if(strlen($signature))
				{
					return '
					<p>
					<b style="font-size:110%;">Best Regards</b><br />
					Praise Khumalo<br />
					Createfile Software (Founder) <br />
					<i>www.createfile.co.za</i>';
				}
			}

		/* ---------------------------------- Nandii API ---------------------------------- */
		/**
		 * This function by default, fetches all available posts from the Nandii database.
		 * It can also fetch based on the filters given and the Limit of posts per retrieval.
		 * The limit is 10 by default
		 */
		public function nandii_fetch_posts($type="", $limit=10)
		{
			try{
				// prepare and execute given query
				$__smt = $this->pdo->prepare("SELECT * FROM `posts` ORDER BY id DESC LIMIT $limit");
				
				// get number of matching rows
				$count = $__smt->rowCount();

				// initiate posts
				$posts = '';

				if($__smt->execute()):

						// number of each row fetched 
						$num = 1;

						while($row = $__smt->fetch()):
							// get the values from the database
							$id        = $row['id'];
							$title     = $row['title'];
							$post      = $row['post'];
							$image     = $row['image'];
							$category  = $row['category'];
							$author    = $row['author'];
							$date      = $row['date'];

							if( strlen($title) ):
								$posts .= $this->nandii_build_post_row($num, $id, $title, $post, $image, $category, $author, $date);

								// increment num for number of rows 
								$num++;
							endif;

						endwhile;
				else:
					return $__smt->errorInfo();
				endif;

			}catch( PDOException $ex){
				return $ex->getMessage();
			}

			// return to the caller
			return $posts;
		}
			/**
			 * This function returns each row of the post fetched from Nandii database. It is usually overridden upon
			 * development to give a different feeling to each project
			 */
			public function nandii_build_post_row($num, $id, $title, $post, $image, $category, $author, $date)
			{
				return '
				<div id="'.$id.'-nandii-post-row" class="nandii-post-row cf">
					<div class="counter">
						<div class="circle-rounding">
							'.$num.'
						</div>
					</div>
					<div class="title">
						'.$this->word_wrap($title, 32).'
					</div>
				</div>';
			}

		public function nandii_fetch_pages($type="", $limit=10)
		{
			try{
				// prepare and execute given query
				$__smt = $this->pdo->prepare("SELECT * FROM `pages` ORDER BY id DESC LIMIT $limit");
				
				// get number of matching rows
				$count = $__smt->rowCount();

				// initiate page
				$pages = '';

				if($__smt->execute()):
					// number of each row fetched 
					$num = 1;

					// start fetching...
					while($row = $__smt->fetch()):
						// get the values from the database
						$id        = $row['id'];
						$title     = $row['title'];
						$page      = $row['page'];
						$author    = $row['author'];
						$date      = $row['date'];

						if( strlen($title) ):
							$pages .= $this->nandii_build_page_row($num, $id, $title, $page, $author, $date);

							// increment num for number of rows 
							$num++;
						endif;
					endwhile;

				else:
					return $__smt->errorInfo();
				endif;

			}catch( PDOException $ex){
				return $ex->getMessage();
			}
			return $pages;
		}
			public function nandii_build_page_row($num, $id, $title, $page, $author, $date)
			{
				return '
				<div id="'.$id.'-nandii-page-row" class="nandii-page-row cf">
					<div class="counter">
						<div class="circle-rounding">
							'.$num.'
						</div>
					</div>
					<div class="title">
						'.$title.'
					</div>
				</div>';
			}

		/**
		 * This function by default, fetches all available comments from the Nandii database.
		 * It can also fetch based on the filters given and the Limit of comments per retrieval.
		 * The limit is 10 by default
		 */
		public function nandii_fetch_comments($type="", $limit=10)
		{
			try{
				// prepare and execute given query
				$__smt = $this->pdo->prepare("SELECT * FROM `comments` ORDER BY id DESC LIMIT $limit");
				
				// get number of matching rows
				$count = $__smt->rowCount();

				// initiate posts
				$posts = '';

				if($__smt->execute()):

						// number of each row fetched 
						$num = 1;

						while($row = $__smt->fetch()):
							// get the values from the database
							$id        = $row['id'];
							$post_id   = $row['post_id'];
							$comment   = $row['comment'];
							$author    = $row['author'];
							$date      = $row['date'];

							if( strlen($comment) ):
								$posts .= $this->nandii_build_comment_row($num, $id, $comment, $post_id, $author, $date);

								// increment num for number of rows 
								$num++;
							endif;

						endwhile;
				else:
					return $__smt->errorInfo();
				endif;

			}catch( PDOException $ex){
				return $ex->getMessage();
			}

			// return to the caller
			return $posts;
		}
			/**
			 * This function returns each row of each comment fetched from Nandii database. It is usually overridden upon
			 * development to give a different feeling to each project
			 */
			public function nandii_build_comment_row($num, $id, $comment, $post_id, $author, $date)
			{
				return '
				<div id="'.$id.'-nandii-comment-row" class="nandii-comment-row cf">
					<div class="counter">
						<div class="circle-rounding">
							'.$num.'
						</div>
					</div>
					<div class="title">
						'.$comment.'
					</div>
				</div>';
			}

		/**
		 * This function by default, fetches all available users from the Nandii database.
		 * It can also fetch based on the filters given and the Limit of comments per retrieval.
		 * The limit is 10 by default
		 */
		public function nandii_fetch_users($type="", $limit=10)
		{
			try{
				// prepare and execute given query
				$__smt = $this->pdo->prepare("SELECT * FROM `users` ORDER BY id DESC LIMIT $limit");
				
				// get number of matching rows
				$count = $__smt->rowCount();

				// initiate posts
				$posts = '';

				if($__smt->execute()):

						// number of each row fetched 
						$num = 1;

						while($row = $__smt->fetch()):
							// get the values from the database
							$id         = $row['id'];
							$firstname  = $row['firstname'];
							$lastname   = $row['lastname'];
							$email      = $row['email'];
							$cell       = $row['cell'];
							$role       = $row['role'];
							$date       = $row['date'];

							if( strlen($firstname) ):
								$posts .= $this->nandii_build_user_row($num, $id, $firstname, $lastname, $email, $cell, $role, $date);

								// increment num for number of rows 
								$num++;
							endif;

						endwhile;
				else:
					return $__smt->errorInfo();
				endif;

			}catch( PDOException $ex){
				return $ex->getMessage();
			}

			// return to the caller
			return $posts;
		}
			/**
			 * This function returns each row of each user fetched from Nandii database. It is usually overridden upon
			 * development to give a different feeling to each project
			 */
			public function nandii_build_user_row($num, $id, $firstname, $lastname, $email, $cell, $role, $date)
			{
				return '
				<div id="'.$id.'-nandii-user-row" class="nandii-user-row cf">
					<div class="counter">
						<div class="circle-rounding">
							'.$num.'
						</div>
					</div>
					<div class="title">
						'.$firstname.' '.$lastname.'
					</div>
				</div>';
			}
	}
?>