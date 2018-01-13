<?php
	
	class user_insert
	{
		protected $check;
		protected $bind;
		protected $sql;
		public $result = 0;
		public $row;

		function __construct($credentials, $model, $fields, $values){
			try{
				$bool = is_numeric(array_keys($values)[0]);
				$fields = $bool != 1 ? array_keys($values) : array_keys($values[0]);
				$values = $bool != 1 ? array_values($values) : $values;
				$model = validate::escape($model);	
				$this->check = new user_connect($credentials);
				filter_var_array($fields, FILTER_SANITIZE_MAGIC_QUOTES);
				filter_var_array($values, FILTER_SANITIZE_MAGIC_QUOTES);					
				$d = count($fields);
				$h = $bool != 1 ? (count($values) / $d) : count($values);
				for ($i=0; $i < $h; $i++) { 
					$arr = array();
					$e = "";
					$f = "";
					for ($j=0; $j < $d; $j++) { 
						$e = $e."?, ";
						$f = $f."s";
						$k = ($d * $i) + $j;
						if($bool != 1) $arr[$j] = &$values[$k];
						else {
							$store = array_values($values[$i]);
							$arr[$j] = &$store[$j];
						}
					}
					$e = chop($e, ", ");
					$l = implode(", ", $fields);
					array_unshift($arr, $f);
					$this->sql = "INSERT INTO `$model` ($l) VALUES($e)";
					$this->bind = $this->check->connect->prepare($this->sql);
					if(!$this->bind) $this->result = "e99";
		 		 	else{
						$ref = new ReflectionClass('mysqli_stmt'); 
			 			$method2 = $ref->getMethod("bind_param"); 
						$method2->invokeArgs($this->bind, $arr);
		 				$this->bind->execute();
		 			}		 			
		 		}
		 		$this->result += $this->bind->affected_rows;
				$this->check->connect->close();
			} catch (\Exception $e) {
				console::log($e, 'err.log');
			}
 		}

 		function __tostring(){
 			return json_encode($this->result);
 		}
	}
?>