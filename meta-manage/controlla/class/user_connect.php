<?php

	class user_connect
	{
		public $user;
		protected $pass;
		protected $url;
		protected $db;
		public $connect;
		public $test;
		
		function __construct($a)
		{
			$this->connect = new mysqli($a[0], $a[1], $a[2], $a[3]);
			if($this->connect->connect_error){
				$this->test = "false";
			}
			else{
				$this->test = "true";
			}
		}

		function __tostring(){
			return $this->test;
		}
	}
?>