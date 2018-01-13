<?php  

	require_once("class/autoload.php");

	class parse_data
	{
		public $a;
		public $b;
		public $check;
		public $name;

		function __construct($type)
		{

			for ($i=1; $i <= $check; $i++) { 
				$modulus = $i % $name;
				$reload = $i % $name;
				if ($reload == 0) {
					$reload = $name;
				}
				if (array_key_exists("input_".$i, $_REQUEST)) {
					$c[$reload] = $_REQUEST["input_".$i];
				}
				else{
					foreach ($_FILES as $key => $value) {
						$compare = ltrim($key, "input_");
						if ($compare == $i) {
							$c[$reload] = $_FILES[$key]["name"];
							$upload = new upload_resource($_FILES[$key], "uploads");
							$upload->upload_file();
							echo $upload;
							$upload = NULL;
						}
					}
				}
				if ($modulus == 0) {
					$obj = new insert($fx->a, $fx->b, $c);
					echo $obj;
					$obj = NULL;
				}
				else{}
			}
		}
	}



?>