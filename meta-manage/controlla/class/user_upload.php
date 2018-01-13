<?php  

	class user_upload
	{
		protected $file;
		protected $name;
		protected $base_name;
		protected $size;
		protected $type;
		protected $error;
		protected $target_dir;
		protected $tmp_file;
		protected $result;
		protected $check;
		protected $image_check;
		
		function __construct($a, $b)
		{
			$this->file = $a;
			$this->target_dir = $b."/";
			$this->base_name = basename($a["name"]);
			$this->cloud_storage = $this->target_dir.$this->base_name;
			$this->type = $a["type"];
			$this->tmp_file = $a["tmp_name"];
			$this->size = $a["size"];
			$this->check = pathinfo($this->cloud_storage, PATHINFO_EXTENSION);
			$this->upload_file();
		//	$this->image_check = getimagesize($this->tmp_file);
		}

		function check_file(){
			if ($this->check != "jpg" &&
				$this->check != "png" &&
				$this->check != "gif" &&
				$this->check != "jpeg" &&
				$this->check != "pdf" &&
				$this->check != "mp4" &&
				$this->check != "mkv" &&
				$this->check != "flv" &&
				$this->check != "docx" &&
				$this->check != "doc" &&
				$this->check != "3gp" &&
				$this->check != "mp3" &&
				$this->check != "ogg" &&
				$this->check != "wav" &&
				$this->check != "wmv" &&
				$this->check != "webm" &&
				$this->check != "xlsx" &&
       			$this->check != "txt" &&
       			$this->check != "zip" &&
       			$this->check != "mpeg"
       		) {
				$this->error = false;
			}
			elseif (file_exists($this->cloud_storage)) {
				$this->error = false;
			}
			else{
				$this->result = true;
			}
		}

		function upload_file(){
			$this->check_file();
			if ($this->error !== false) {
				move_uploaded_file($this->tmp_file, $this->cloud_storage);
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