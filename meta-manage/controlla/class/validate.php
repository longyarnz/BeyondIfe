<?php  

	class validate
	{
		static function escape($a){
		//	$a = filter_var($a, FILTER_SANITIZE_MAGIC_QUOTES);
			return $a;
		}

		static function replace($a){
			$a = str_replace("'", "~~", $a);
			$a = str_replace("--", "##", $a);
			$a = str_replace("\"", "%%", $a);
			return $a;
		}

		static function restore($a){
			$a = str_replace("~~", "'", $a);
			$a = str_replace("##", "--", $a);
			$a = str_replace("%%", "\"", $a);
			return $a;
		}
	}
?>