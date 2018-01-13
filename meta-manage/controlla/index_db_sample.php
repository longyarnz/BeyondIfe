<?php 

	require_once($_SERVER["DOCUMENT_ROOT"]."/autoload.php");

	function send_to_upload($value){
		$upload = new upload_resource($value, "uploads");
	}

//	var_dump($_REQUEST);

	if($_REQUEST['query'] == "ink") {

		$name = $_REQUEST['name'];
		$type = $_REQUEST['type'];
		$check = $_REQUEST['check'];
		$fx = new switcher($type);

		$c = array();

		for ($i=1; $i <= $check; $i++) { 
			$modulus = $i % $name;
			$reload = $i % $name;
			if ($reload == 0) {
				$reload = $name;
			}
			if (array_key_exists("input_".$i, $_REQUEST)) {
				$c[$reload] = $_REQUEST["input_".$i];
			}
			else{
				foreach ($_FILES as $key => $value) {
					$compare = ltrim($key, "input_");
					if ($compare == $i) {
						$c[$reload] = $_FILES[$key]["name"];
						$upload = new upload_resource($_FILES[$key], $_SERVER["DOCUMENT_ROOT"]."/images/uploads/".$type);
						$upload->upload_file();
						$upload = NULL;
					}
				}
			}
			if ($modulus == 0) {
				$obj = new insert($fx->a, $fx->b, $c);
				echo $obj;
				$obj = NULL;
			}
			else{}
		}
	}

	elseif ($_REQUEST['query'] == "sell") {
		$type = $_REQUEST['type'];
		$fx = new switcher($type);
		$call_db = new select();
		$call_db->retrieve_bind($fx->a, $fx->b);
		$call_db = NULL;
	}

	elseif ($_REQUEST['query'] == "upd"){
		$check = $_REQUEST['check'];
		$type = $_REQUEST['type'];
		$column = $_REQUEST['column'];
		$where = $_REQUEST['where'];

		if(empty($_FILES)){
			$content = $_REQUEST['input_'.$check];
		//	var_dump($content);
		}
		else{
			$content = $_FILES['input_'.$check]['name'];			
			$upload = new upload_resource($_FILES['input_'.$check], $_SERVER["DOCUMENT_ROOT"]."/images/uploads/".$type);
			$upload->upload_file();
			$upload = NULL;
			var_dump($content);
		}

		$fx = new switcher($type);
		$update_db = new update();
		$update_db->update_single($fx->a, $column, $content, $where);	
	//	var_dump($_REQUEST);
	}

	elseif ($_REQUEST['query'] == "comment") {
		$c[0] = "";
		$c[] = $_REQUEST['title'];
		$c[] = $_REQUEST['input_1'];
		$c[] = $_REQUEST['input_2'];
		$fx = new switcher($_REQUEST['type']);
		$obj = new insert($fx->a, $fx->b, $c);
		echo $obj;
		$obj = NULL;
	}

	elseif ($_REQUEST['query'] == "pass") {
		for ($i=1; $i < 5; $i++) { 
			$input[$i] = $_REQUEST['input_'.$i];
		}
		$control = new select();
		$options = new switcher("control");
		$control->retrieve_order($options->a, $options->b, $options->b[0], 6);
		$control = explode("&&&", $control);
		$echo = "It Didn't <span class='red-text'>Go Right</span> This Time, A Next Time, Maybe?";

		foreach ($control as $key => $value) {			
			$value = explode("(((", $value);
			if ($value[0] == $input[1] && $value[1] == $input[2]) {
				$conform = new update();
				$conform->update_single($options->a, $options->b[0], $input[3], $value[0]);
				$conform->update_single($options->a, $options->b[1], $input[4], $value[1]);
				$echo = "Oscar!! Bumaye, <span class='red-text'>Oscar!!! Bumaye, </span>Oscar!!!! Bumaye";
			}
		}

		echo $echo;
	}
?>