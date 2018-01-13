<?php  

	require_once($_SERVER["DOCUMENT_ROOT"]."/autoload.php");

	class switcher
	{
		public $a;
		public $b;
		public $c;
		public $d;

		function __construct($type)
		{
			switch ($type) {
				case "president":
					$this->a = "president";
					$this->b = "`picture`";
					$this->c = 1;
					break;
				case "update":
					$this->a = "updates_tabs";
					$this->b = "`content`";
					$this->c = 1;
					break;
				case "download":
					$this->a = "downloads_tabs";
					$this->b = array("`name`", "`download`");
					$this->c = 2;
					break;
				case "exco":
					$this->a = "exco_profiles";
					$this->b = array("`title`", "`name`", "`level`", "`set`", "`picture sm`", "`picture xl`");
					$this->c = 6;
					break;
				case "event":
					$this->a = "event_tabs";
					$this->b = array("`name`", "`time`", "`date`", "`venue`", "`banner sm`", "`banner xl`");
					$this->c = 6;
					break;
				case "blog":
					$this->a = "blog_tabs";
					$this->b = array("`title`", "`content`", "`picture`");
					$this->c = 3;
					break;
				case "blog_time":
					$this->a = "blog_tabs";
					$this->b = array("`title`", "`content`", "`picture`", "`time_stamp`");
					$this->c = 4;
					break;
				case "image":
					$this->a = "pictures";
					$this->b = array("`name`", "`folder`", "`picture sm`", "`picture xl`");
					$this->c = 4;
					break;
				case "video":
					$this->a = "videos";
					$this->b = array("`name`", "`video`");
					$this->c = 2;
					break;
				case "comment":
					$this->a = "read_comments";
					$this->b = array("`title`", "`name`", "`comment`");
					$this->c = 3;
					break;
				case "write":
					$this->a = "read_comments";
					$this->b = array("`title`", "`name`", "`comment`", "`time_stamp`");
					$this->c = 4;
					break;
				case "control":
					$this->a = "firewalls";
					$this->b = array("`oruko`", "`asiri`");
					$this->c = 4;
					break;
				default:
					$this->a = "";
					$this->b = "";
					$this->c = "";
				break;
			}
		}
	}



?>