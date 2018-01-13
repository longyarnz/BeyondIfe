<?php 

	class console
	{
		public static function log($object, $append = false, $log = 'msg.log'){
			file_put_contents($log, print_r($object, true)."\n", $append == true ? FILE_APPEND : '');
		}
	}
?>