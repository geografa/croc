<?php

//	ini_set("include_path", ".:/usr/lib64/php:/usr/lib/php:/home7/simonlyl/public_html/croc");

	$page = $_GET['page'];
	
	if (!$page) {
		$page = "home";
	}
	include("header.php");
	
	include("content/".$page.".php");
		
	include("footer.php");
?>