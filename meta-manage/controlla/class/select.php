<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/autoload.php");

	class select
	{
		protected $check;
		protected $bind;
		protected $sql;
		public $result;
		protected $row;
		protected $meta;
		public $col;
		protected $col1;
		protected $col2;
		protected $col3;


		function retrieve_bind($a, $b){
			$a = validate::escape($a);
			$this->col = array();
			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				foreach ($b as $key => $value) {
					$c[] = &$value;	
				}
				$b = implode(", ", $b);
			}
			elseif(is_string($b)){
				$b = validate::escape($b);
			}
 			$this->check = new connect();
			$this->sql = "SELECT $b FROM `$a` ORDER BY `id` DESC";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			$this->bind->execute();
 			// $this->col = array();

 			// $this->meta = $this->bind->result_metadata();
 			// while ($field = $this->meta->fetch_field()) {
 			// 	$this->col[] = &$field->name;
 			// }
			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
			while ($this->bind->fetch()) {
 				echo implode("|", $this->col)."|";
			}
 			$this->bind->close();
	 	}

	 	function retrieve_where($a, $b, $c, $d){
 			$b = validate::escape($b);
 			if(is_array($a)){
				filter_var_array($a, FILTER_SANITIZE_MAGIC_QUOTES);
				$a = implode(", ", $a);
			}
			elseif(is_string($a)){
				$b = validate::escape($a);
			}
 			$c = validate::escape($c);
 			$d = validate::escape($d);
 			$this->sql = "SELECT `$b` FROM `$a` WHERE $c = ?";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			$this->bind->bind_param('s', $d);
 			$this->bind->execute();
 			$this->col = array();
 			$this->meta = $this->bind->result_metadata();
 			while ($field = $this->meta->fetch_field()) {
 				$this->col[] = &$field->name;
 			}
			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
 			while($this->bind->fetch()) {
 				echo $this->col;
 			}

 			$this->blnd->close();
 		}

 		function retrieve_order($a, $b, $c, $d){
 			$this->result = array();
			$a = validate::escape($a);
			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$b = implode(", ", $b);
			}
			elseif(is_string($b)){
				$b = validate::escape($b);
			}
 			$this->check = new connect();
			$this->sql = "SELECT $b FROM $a ORDER BY $c DESC LIMIT $d";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			$this->bind->execute();
 			$this->col = array();
 			$this->meta = $this->bind->result_metadata();
 			while ($field = $this->meta->fetch_field()) {
 				$this->col[] = &$field->name;
 			}
			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
			while ($this->bind->fetch()) {
 				$this->result[] = implode("(((", $this->col);
			}
 			$this->bind->close();
	 	}

	 	function retrieve_distinct($a, $b, $c, $d){
 			$this->result = array();
			$a = validate::escape($a);
			if(is_array($b)){
				filter_var_array($b, FILTER_SANITIZE_MAGIC_QUOTES);
				$b = implode(", ", $b);
			}
			elseif(is_string($b)){
				$b = validate::escape($b);
			}
 			$this->check = new connect();
			$this->sql = "SELECT DISTINCT $b FROM $a ORDER BY $c DESC LIMIT $d";
 			$this->bind = $this->check->connect->prepare($this->sql);
 			$this->bind->execute();
 			$this->col = array();
 			$this->meta = $this->bind->result_metadata();
 			while ($field = $this->meta->fetch_field()) {
 				$this->col[] = &$field->name;
 			}
			call_user_func_array(array($this->bind, 'bind_result'), $this->col);
			while ($this->bind->fetch()) {
 				$this->result[] = implode("(((", $this->col);
			}
 			$this->bind->close();
	 	}

		function __tostring(){
			return implode("&&&", $this->result);
		}
	}
?>