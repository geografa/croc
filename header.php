<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>CROC</title>
	<!-- 960 grid system -->
	<link href="css/960.css" type="text/css" rel="stylesheet" />
	<link href="css/reset.css" type="text/css" rel="stylesheet" />
	<link href="css/text.css" type="text/css" rel="stylesheet" />
	
	<!-- croc specific styles -->
	<link href="css/styles.css" type="text/css" rel="stylesheet" />
	
	<!-- javascript includes -->
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</head>
<body>
	<div class="container_12">
		<div class="grid_12 shadow" id="mainback">
			<div id="picback">
			</div><!--/picback-->
			<div id="navback">
				<ul id="nav">
					<?php
					$sections = array("Home", "Schedule", "Training", "Membership", "Youth", "Getting Started");
					foreach($sections as $row) {
						echo "<li class=\"nav\"><a href=\"index.php?page=$row\"";
						if($row==$page) {
							echo "class=\"selected\"";
						}
						echo ">$row</a></li>\n";
					} 
					?>
				</ul>
				<!-- Twitter-->
				<div id="tweet">
					<img src="img/twitter-icon.png" width="32" height="32" alt="Twitter Icon"><img src="img/facebook-icon.gif" width="32" height="31" alt="Facebook Icon">
				</div>
				<!--/Twitter-->
			</div><!--/navback-->
			<div id="content">
<!--end header-->