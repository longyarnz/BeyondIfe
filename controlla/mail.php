<?php 

	require_once($_SERVER["DOCUMENT_ROOT"]."/autoload.php");

	if(isset($_REQUEST['input_0'])){
		$to = "beyondife7@gmail.com";
		$subject = "New Nominations For BeyondIfe";
		$message = "";
		foreach ($_REQUEST as $key => $value) {
			$index = substr($key, 6); $title = "";
			$name = ""; $preTitle = $index == 0 ? "STUDENT LEADERSHIP CATEGORY\n\n" : "";
			$name = $index % 5 == 0 ? "Name" : $name;
			$name = $index % 5 == 1 ? "Department" : $name;
			$name = $index % 5 == 2 ? "Level" : $name;
			$name = $index % 5 == 3 ? "Business Owned" : $name;
			$name = $index % 5 == 4 || $index == 17 ? "Reasons For Nomination" : $name;
			$name = $index == 3 ? "Association/Organization of Nominee" : $name;
			$name = $index == 16 ? "Activities of the Organization" : $name;
			$title = $index == 4 ? "\n\nMALE ENTREPRENEUR CATEGORY\n\n" : $title;
			$title = $index == 9 ? "\n\nFEMALE ENTREPRENEUR CATEGORY\n\n" : $title;
			$title = $index == 14 ? "\n\nSTUDENT-FRIENDLY ORGANIZATION CATEGORY\n\n" : $title;
			$content = $preTitle."$name  ---  $value\n".$title;
			$message += $content;
			console::log($content, true, 'NOM.log');
		}
		console::log($_SERVER['REMOTE_ADDR'], true, 'IP.log');
		// mail($to, $subject, $message);
		// mail('linksolojayz@gmail.com, $subject, $message);
		$credentials = ['localhost', 'lekan', 'longyarn', 'beyondife_db'];
		$insert = new user_insert($credentials, 'remote_ip', 'ip', ["ip" => $_SERVER['REMOTE_ADDR']]);
		echo json_encode("Your Grace");
	}
	else{
		$to = "beyondife7@gmail.com";
		$name = @$_REQUEST['input_1'];
		$email = @$_REQUEST['input_2'];
		$message = "My name is $name and you may contact me at $email\n\n".@$_REQUEST['input_3'];
		$subject = "Message From Beyondife Website";
		if(mail($to, $subject, $message)){
			echo json_encode($name);
		}
	}	
?>