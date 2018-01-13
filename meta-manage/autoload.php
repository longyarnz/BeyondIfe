<?php

	function __autoload($class){
		require_once($_SERVER["DOCUMENT_ROOT"]."/controlla/class/".$class.".php");
	}
?>