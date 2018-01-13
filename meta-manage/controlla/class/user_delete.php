<?php

	require_once("./autoload.php");

	class user_delete
	{
		protected $check;
		protected $bind;
		public $sql;
		public $result;
		public $row;
		protected $ab;

		function delete_single($con, $a, $b, $c){
 			$this->check = new connect($con);
 			$this->sql = "DELETE FROM $a WHERE `$b`=?";
 			$this->bind = $this->check->connect->prepare($this->sql);

 			for ($i=0; $i < count($c); $i++) { 
	 			$this->bind->bind_param('s', $c[$i]);
	 			$this->bind->execute();
			}
			$this->row = $this->check->connect->affected_rows;
 			if ($this->row > 0) {
 				echo "Well Done";
 			}
 			else{
 				echo "You can do better";
 			}
 		}

 		function delete_batch($con, $a, $b){
			$a = validate::escape($a);
			filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
			$num = count($b);
 			$where = "";
 			for ($i = 0; $i < $num; $i++) {
 				if ($i == 0 || $i % 2 == 0) {
 				 	$where = $where."`$b[$i]` = '".$b[$i + 1]."'";
 				}
 				elseif($i % 2 == 1 && $num - $i != 1){
 					$where = $where." AND ";
 				}
 			}
 			$this->check = new user_connect($con);
 			$this->sql = "DELETE FROM `$a` WHERE $where";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->result = false; 		 		
 		 	}
 		 	else{
	 			$this->bind->execute();
	 			$this->row = $this->check->connect->affected_rows;

	 			if ($this->row > 0) {
	 				$this->result = true;
	 			}
	 			else{
	 				$this->result = false;
	 			}
	 		}
 		}
	}
?>