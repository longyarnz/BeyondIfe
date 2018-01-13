<?php

	require_once("./autoload.php");

	class user_select
	{
		public $check;
		protected $bind;
		public $sql;
		public $result;
		protected $row;
		protected $meta;
		public $col;
		protected $col1;
		protected $col2;
		public $error;


		function retrieve_bind($con, $a, $b){
			$a = validate::escape($a);

			$this->col = array();

			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$fd = count($b);
				for ($i=0;$i < $fd;$i++) {
					$this->col[] = &$b[$i];	
				}
				$b = implode(", ", $b);
			}

			elseif(is_string($b)){
				$b = validate::escape($b);
				$this->col[] = &$b;				
			}

 			$this->check = new user_connect($con);

			$this->sql = "SELECT $b FROM `$a`";

 		 	$this->bind = $this->check->connect->prepare($this->sql);

 		 	if(!$this->bind){
 		 		$this->error = true; 		 		
 		 	}
 		 	else{

	 		 	$this->bind->execute();

	 		 	call_user_func_array(array($this->bind, 'bind_result'), $this->col);
	 			
	 			while ($this->bind->fetch()) {
					foreach ($this->col as $key => $value) {
						$this->result[] = $value;
					}
				}
				$this->bind->free_result();
	 			$this->bind->close();
	 		}
	 		$this->check->connect->close();
	 	}

	 	function retrieve_where($con, $a, $b, $c){
 			$a = validate::escape($a);
 			$fada = $b;
 			$this->col = array();
 			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$fd = count($b);
				for ($i=0;$i < $fd;$i++) {
					$this->col[] = &$b[$i];	
				}
				$b = implode(", ", $b);
			}
			else{
				$b = validate::escape($b);
				$this->col[] = &$b;
			}
 			filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
 			$this->check = new user_connect($con);
 			$this->sql = "SELECT $b FROM `$a` WHERE `$c[0]` = ?";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->error = true; 		 		
 		 	}
 		 	else{
	 			$this->bind->bind_param('s', $c[1]);
	 			$this->bind->execute();
	 			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
	 			while($this->bind->fetch()) {
	 				foreach ($this->col as $key => $value) {
						$this->result[] = $value;
					}
	 			}

	 			$this->bind->free_result();
	 			$this->bind->close();
	 		}
	 		$this->check->connect->close();
 		}

 		function retrieve_where_schema($con, $a, $b, $c){
 			$a = validate::escape($a);
 			$this->col = array();
 			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$fd = count($b);
				for ($i=0;$i < $fd;$i++) {
					$this->col[] = &$b[$i];	
				}
				$b = implode(", ", $b);
			}
			else{
				$b = validate::escape($b);
				$this->col[] = &$b;
			}
 			filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
 			$num = count($c);
 			$where = "";
 			$sss = "";
 			for ($i=0; $i < $num; $i++) {
 				if ($i == 0 || $i % 2 == 0) {
 				 	$where = $where."`$c[$i]` = ?";
 				 	$sss = $sss.'s';
 				 	$this->col1[0] = $sss;
 				 	$this->col1[] = &$c[$i + 1]; 
 				}
 				elseif($i % 2 == 1 && $num - $i != 1){
 					$where = $where." AND ";
 				}
 			}
 			$this->check = new user_connect($con);
 			$this->sql = "SELECT $b FROM `$a` WHERE $where";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->error = true; 		 		
 		 	}
 		 	else{
	 			call_user_func_array(array($this->bind, 'bind_param'), $this->col1);
	 			$this->bind->execute();
	 			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
	 			while($this->bind->fetch()) {
	 				foreach ($this->col as $key => $value) {
						$this->result[] = $value;
					}
	 			}

	 			$this->bind->free_result();
	 			$this->bind->close();
	 		}
	 		$this->check->connect->close();
 		}

 		function retrieve_order($con, $a, $b, $c){
 			$this->result = array();
			$a = validate::escape($a);
			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$fd = count($b);
				for ($i=0;$i < $fd;$i++) {
					$this->col[] = &$b[$i];	
				}
				$b = implode(", ", $b);
			}
			else{
				$b = validate::escape($b);
				$this->col[] = &$b;	
			}
			filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
 			$this->check = new user_connect($con);
			$this->sql = "SELECT $b FROM `$a` ORDER BY `$c[0]` DESC LIMIT $c[1]";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->error = true; 		 		
 		 	}
 		 	else{
	 			$this->bind->execute();
	 			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
				while ($this->bind->fetch()) {
	 				foreach ($this->col as $key => $value) {
						$this->result[] = $value;
					}
				}
	 			$this->bind->free_result();
	 			$this->bind->close();
	 		}
	 		$this->check->connect->close();
	 	}

	 	function retrieve_distinct($con, $a, $b, $c){
 			$this->result = array();
			$a = validate::escape($a);
			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$fd = count($b);
				for ($i=0;$i < $fd;$i++) {
					$this->col[] = &$b[$i];	
				}
				$b = implode(", ", $b);
			}
			else{
				$b = validate::escape($b);
				$this->col[] = &$b;	
			}
			filter_var_array($c, FILTER_SANITIZE_MAGIC_QUOTES);
 			$this->check = new user_connect($con);
			$this->sql = "SELECT DISTINCT $b FROM `$a` ORDER BY `$c[0]` DESC LIMIT $c[1]";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			if(!$this->bind){
 		 		$this->error = true; 		 		
 		 	}
 		 	else{
	 			$this->bind->execute();
	 			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
				while ($this->bind->fetch()) {
	 				foreach ($this->col as $key => $value) {
						$this->result[] = $value;
					}
				}
	 			$this->bind->free_result();
	 			$this->bind->close();
	 		}
	 		$this->check->connect->close();
	 	}

		function __tostring(){
			$this->result = json_encode($this->result);
			return $this->result;
		}
	}
?>