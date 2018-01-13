<?php

	require_once("./autoload.php");

	class user_insert
	{
		protected $check;
		protected $bind;
		protected $sql;
		public $result;
		public $row;

		function __construct($con, $a, $b, $c){
			$a = validate::escape($a);	
			$this->check = new user_connect($con);
			$this->result = "yes 1";

 			if (is_array($b)) {
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
				
				$d = count($b);
				$h = count($c) / $d;
				for ($i=0; $i < $h; $i++) { 
					$arr = array();
					$e = "";
					$f = "";

					for ($j=0; $j < $d; $j++) { 
						$e = $e."?, ";
						$f = $f."s";
						$k = ($d * $i) + $j;
						$arr[$j] = &$c[$k];
					}

					$e = chop($e, ", ");
					$l = implode(", ", $b);
					array_unshift($arr, $f);

					$this->sql = "INSERT INTO `$a` ($l) VALUES($e)";
					$this->bind = $this->check->connect->prepare($this->sql);
					if(!$this->bind){
		 		 		$this->result = false;
		 		 	}
		 		 	else{
						call_user_func_array(array($this->bind, 'bind_param'), $arr);
		 				$this->bind->execute();
		 				array_shift($arr);
		 			}
				}
				$this->row = $this->bind->affected_rows;			
			} 
			else{
				$b = validate::escape($b);
				$this->sql = "INSERT INTO `$a` ($b) VALUES(?)";
 				$this->bind = $this->check->connect->prepare($this->sql);

 				if(!$this->bind){
	 		 		$this->result = false;
	 		 	}
	 		 	else{
					if (is_array($c)) {
						filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
						$d = count($c);
						for ($i=0; $i < $d; $i++) { 
							$this->bind->bind_param('s', $c[$i]);
							$this->bind->execute();
						}
					}
					else{
						$this->bind->bind_param('s', $c);
						$this->bind->execute();
					}
					$this->row = $this->bind->affected_rows;
		 		}
 			} 			

 			if ($this->row > 0) {
 				$this->result = true;
 			}
 			else{
 				$this->result = false;
 			}
 		}

 		function __tostring(){
 			$this->result = json_encode($this->result);
 			return $this->result;
 		}
	}
?>