<?php 

	session_start();

	require_once("autoload.php");

	$parse_file = parse_ini_file("../config/config.ini");

	$inputs = array();

	function access(){
		global $parse_file;
		$_SESSION['connect'] = null;
		$url = $parse_file['url'];
		$user = $_REQUEST["input_1"];
		$pass = $_REQUEST["input_2"];
		$db = $parse_file['database'];
		$connect = new mysqli($url, $user, $pass, $db);
		if ($connect->connect_error) {
			$json[] = "Invalid Access Codes";
			$json = json_encode($json);
			echo $json;	
			exit();		
		}
		else{
			$_SESSION['connect'] = array($url, $user, $pass, $db);
			if ($_REQUEST && $_FILES) {
				foreach ($_REQUEST as $key => $value) {
		 			$sub = substr($key, 0, 6);
					if ($sub != "input_") {
						${$key} = $value;
						$cram[] = ${$key};
					}
		 		}
		 		for ($i=0; $i < 3; $i++) { 
					array_pop($_REQUEST);
				}
				$_REQUEST = array_merge($_REQUEST, $_FILES);
				foreach ($_REQUEST as $key => $val) {
					if (!is_string($val)) {
						$upload = new user_upload($val, $_SERVER["DOCUMENT_ROOT"]."/uploads");
						$_REQUEST[$key] = $val["name"];	
						$_REQUEST["inputs"][] = $val["name"];
					}
					else{
						$_REQUEST["inputs"][] = $val;
					}		
				}
			}
			return true;
		}		
	}

	if ($_REQUEST["type"] == "access") {
		global $parse_file;
		$connect = access();
		if ($connect) {
			$select_tables = new user_select();
			$select_tables->retrieve_tables($_SESSION['connect']);  // select database tables
			if ($select_tables->error) {
				echo json_encode("Invalid Access Codes 2");
				exit();
			}
			else{
				$datastore = array_flip($select_tables->result);

				foreach ($datastore as $key => $value) { //iterate database tables
			 		$datastore[$key] = array();
			 		$select_columns = new user_select();
			 		$select_columns->retrieve_columns($_SESSION['connect'], $key);
			 		for ($i=0; $i < count($select_columns->result); $i++) { 
			 			$new_key = ucfirst($select_columns->result[$i][0]);
			 			$datatype[$new_key] = $select_columns->result[$i][1];				 		
				 		$datastore[$key][$new_key] = array();
			 		}
	 		 		if ($select_columns->error) {
						echo json_encode("Invalid Access Codes 3");
						exit();
					}
					else{
						foreach ($datastore[$key] as $new_key => $new_value) { //iterate table columns and datatype
							$select_data = new user_select();
							$select_data->retrieve_bind($_SESSION['connect'], $key, $new_key); //select column contents
							if ($select_data->result == null) {
								$datastore[$key][$new_key] = array();
							}
							else{
								$datastore[$key][$new_key] = $select_data->result;
							}
							
						}						
						$datastore[$key]['data_type'] = $datatype;
			 			$datatype = null;
			 			$select_data = null;
					}
			 	}
			}
			echo json_encode($datastore);
		}
	}
	elseif($_REQUEST["type"] == "insert"){
		global $parse_file;
		if ($_SESSION['connect']) {
			$connect = $_SESSION['connect'];
			$return_values = array();
			$msg = "";
			$columns = explode(",", $_REQUEST["cols"]);
			$table = $_REQUEST["tab"];
			if ($_REQUEST && $_FILES) {
				$_REQUEST = array_merge($_REQUEST, $_FILES);
				foreach ($_REQUEST as $key => $val) {
					if (!is_string($val) && $key != "cols" && $key != "tab") {
						$upload = new user_upload($val, $_SERVER["DOCUMENT_ROOT"].$parse_file['upload_path']);
						$way = substr($key, 6);	
						$_REQUEST["inputs"][$way - 1] = $val["name"];
						$return_values[] = $val["name"];
					}
					else{
						$sub = substr($key, 0, 6);
			 			$way = substr($key, 6);
						if ($sub == "input_") {
							$_REQUEST["inputs"][$way - 1] = $val;
						}
					}		
				}
			}
			else{
				foreach ($_REQUEST as $key => $value) {
		 			$sub = substr($key, 0, 6);
		 			$way = substr($key, 6);
					if ($sub == "input_") {
						$_REQUEST["inputs"][$way - 1] = $value;
					}
		 		}
			}
			ksort($_REQUEST["inputs"]);
			$insert_table = new user_insert($connect, $table, $columns, $_REQUEST["inputs"]);
			if($insert_table->result){
				$msg = "Operation Successful";
			}
			else{
				$msg = "Operation Unsuccessful";
			}
			array_unshift($return_values, $msg);
			echo json_encode($return_values);
		}
		else{
			echo "Invalid Access Codes";
		}
	}
	elseif($_REQUEST["type"] == "recess"){
		$_SESSION['connect'] = null;
		$_SESSION['connect_schema'] = null;
		session_destroy();
		echo "Enter Access Codes";
	}
	elseif($_REQUEST["type"] == "update"){
		global $parse_file;
		if ($_SESSION['connect']) {
			$_REQUEST['inputs'] = json_decode($_REQUEST['inputs']);
			$connect = $_SESSION['connect'];
			$return_values = array();
			$return_values[0] = "";
			if ($_REQUEST && $_FILES) {
				$_REQUEST = array_merge($_REQUEST, $_FILES);
				foreach ($_REQUEST as $key => $val) {
					if (is_array($val) && $key != "inputs" && $key != "tab" && $val["name"] != ""){
						$upload = new user_upload($val, $_SERVER["DOCUMENT_ROOT"].$parse_file['upload_path']);
						$_REQUEST['changedValue'] = $val["name"];
						$return_values[0] = $val["name"];
					}
				}
			}
			if ($_FILES && $return_values[0] != "" || !$_FILES) {
				extract($_REQUEST);
				$update_column = new user_update();
				$update_column->update_batch_schema($connect, $tab, $columnName, $changedValue, $inputs);
				if ($update_column->result) {
					$msg = "Mission Accomplished";
				}
			}
			else{
				$msg = "Mission Lost";
			}
			array_unshift($return_values, $msg);
			echo json_encode($return_values);
		}
		else{
			echo "Invalid Access Codes";
		}
	}
	elseif($_REQUEST["type"] == "delete"){
		if ($_SESSION['connect']) {
			$connect = $_SESSION['connect'];
			$return_values = array();
			extract($_REQUEST);
			$inputs = json_decode($inputs);
			$delete_column = new user_delete();
			$delete_column->delete_batch($connect, $tab, $inputs);
			if ($delete_column->result) {
				$msg = "Aim Achieved";
			}
			else{
				$msg = "Aim Lost";
			}
			$return_values[0] = $msg;
			echo json_encode($return_values);
		}
		else{
			echo "Invalid Access Codes";
		}
	}
?>

