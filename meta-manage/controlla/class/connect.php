<?php

	class connect
	{
		public $user = "lekan";
		protected $pass = "longyarn";
		protected $url = "localhost";
		protected $db = "nuasa_db";
		public $connect;
		
		function __construct()
		{
			$this->connect = new mysqli($this->url, $this->user, $this->pass, $this->db);
		}
	}
?>