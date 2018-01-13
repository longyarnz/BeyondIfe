<?php

	require_once("./autoload.php");

	class user_update
	{
		protected $check;
		protected $bind;
		public $sql;
		public $result;
		public $col;
		protected $row;
		protected $ab;

		function update_batch($con, $a, $b, $c, $d){
			$a = validate::escape($a);
			$b = validate::escape($b);
			filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
			filter_var_array($d, FILTER_SANITIZE_MAGIC_QUOTES);
			$this->check = new user_connect($con);
 			$this->sql = "UPDATE `$a` SET `$b`=? WHERE `$b`=?";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->result[] = "Invalid Acess Codes";
 		 	}
 		 	else{
	 			for ($i=0; $i < count($d); $i++) { 
		 			$this->bind->bind_param('ss', $c[$i], $d[$i]);
		 			$this->bind->execute();
					$this->row = $this->check->connect->affected_rows;
				}
	 			
	 			if ($this->row > 0) {
	 				$this->result = true;
	 			}
	 			else{
	 				$this->result = false;
	 			}
	 		}
 		}

 		function update_batch_schema($con, $a, $b, $c, $d){
			$a = validate::escape($a);
			$b = validate::escape($b);
			$c = validate::escape($c);
			filter_var_array($d, FILTER_SANITIZE_MAGIC_QUOTES);
			$this->col = array();
			$num = count($d);
 			$where = "";
 			$sss = "";
 			for ($i = 0; $i < $num; $i++) {
 				if ($i == 0 || $i % 2 == 0) {
 				 	$where = $where."`$d[$i]` = ?";
 				 	$sss = $sss.'s';
 				 	$this->col[0] = $sss;
 				 	$this->col[1] = &$c;
 				 	$this->col[] = &$d[$i + 1]; 
 				}
 				elseif($i % 2 == 1 && $num - $i != 1){
 					$where = $where." AND ";
 				}
 				elseif($num - $i == 1){
 					$sss = $sss.'s';
 					$this->col[0] = $sss;
 				}
 			}
 			$this->check = new user_connect($con);
 			$this->sql = "UPDATE `$a` SET `$b` = ? WHERE $where";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->result = false; 		 		
 		 	}
 		 	else{
	 			call_user_func_array(array($this->bind, 'bind_param'), $this->col);
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

 		function update_single($con, $a, $b, $c, $d){
 			$a = validate::escape($a);
			$b = validate::escape($b);
			$c = validate::escape($c);
			$d = validate::escape($d);
 			$this->check = new user_connect($con);
 			$this->sql = "UPDATE `$a` SET `$b`=? WHERE `$b`=?";
 			$this->bind = $this->check->connect->prepare($this->sql);
			if(!$this->bind){
 		 		$this->result = "Invalid Acess Codes";
 		 	}
 		 	else{
	 			$this->bind->bind_param('ss', $c, $d);
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

 		function __tostring() {
 			$this->result = json_encode($this->result);
 			return $this->result;
 		}
	}
?>