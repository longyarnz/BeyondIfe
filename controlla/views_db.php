<?php  

	session_start();

	require_once($_SERVER["DOCUMENT_ROOT"]."/autoload.php");

	function access(){
		$url = "";
		$user = "lekan";
		$pass = "longyarn";
		$db = "beyondife_db";
		$connect = new mysqli($url, $user, $pass, $db);
		if ($connect->connect_error) {
			echo "Invalid 1";
		}
		else{
			$_SESSION['connect'] = array($url, $user, $pass, $db);
			$_SESSION['connect_schema'] = array($url, $user, $pass, "information_schema");
			return true;
		}		
	}

	$connect = access();
	if ($connect) {
		$select_tables = new user_select();
		$select_tables->retrieve_where($_SESSION['connect_schema'], "tables", "table_name", array("table_schema", $_SESSION['connect'][3]));  // select database tables
		if ($select_tables->error) {
			echo "Invalid Access Codes 2";			
		}
		else{
			$select_tables->result = array_flip($select_tables->result);

			foreach ($select_tables->result as $key => $value) { //iterate database tables
				$select_columns = new user_select();
				$select_columns->retrieve_where_schema($_SESSION['connect_schema'], "columns", array("column_name", "data_type"), 
				array("table_name", $key, "table_schema", $_SESSION['connect'][3], "extra", " ")); //select table columns and their data_type

				$select_tables->result[$key] = array();
				$data_type = array();
				if ($select_columns->error) {
					echo "Invalid Access Codes 3";					
				}
				else{
					foreach ($select_columns->result as $key1 => $value1) { //iterate table columns and datatype
						if ($key1 % 2 == 0) {
							$value1 = ucfirst($value1);
							$select_tables->result[$key][$value1] = array();
							foreach ($select_tables->result[$key] as $key11 => $value11) { //iterate columns only
								$select_data = new user_select();
								$select_data->retrieve_bind($_SESSION['connect'], $key, $key11); //select column contents
								if ($select_data->result == null) {
									$select_tables->result[$key][$value1] = array();
								}
								else{
									$select_tables->result[$key][$value1] = $select_data->result;
								}
								
							}
							$select_data = null;
							$data_type[$value1] = $select_columns->result[$key1 + 1]; //store column types
						}
					}
				}

				$select_tables->result[$key]['data_type'] = $data_type;
				$select_columns = null;
			}
		}
	}
?>