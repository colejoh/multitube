<?php
	session_start();
	
	session_unset();
	session_destroy();
	
	echo "<script type='text/javascript'>window.location ='http://www.colejoh.com/multitube';</script>";
?>