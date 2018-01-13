<?php  

	require_once("autoload.php");

	class video_upload
	{
		protected $file;
		protected $name;
		protected $base_name;
		protected $size;
		protected $type;
		protected $error;
		protected $target_dir;
		protected $tmp_file;
		protected $misc;
		protected $check;
		
		function __construct($a, $b)
		{
			$this->file = $_FILES[$a];
			$this->target_dir = $b."/";
			$this->base_name = basename($this->file["name"]);
			$this->name = $this->target_dir.$this->base_name;
			$this->size = $this->file["size"];
			$this->type = pathinfo($this->name, PATHINFO_EXTENSION);
			$this->tmp_file = $this->file["tmp_name"];
		//	$this->check = getimagesize($this->tmp_file);
		}

		function check_file(){
			if ($this->type != "mp4" && $this->type != "mkv" && $this->type != "avi" && $this->type != "flv") {
				return FALSE;
			}
		}

		function upload_file(){
			move_uploaded_file($this->tmp_file, $this->name);
			if(TRUE){
				$this->misc = 1;
			}
			else{
				$this->misc = 0;
			}
		}
	}
?>