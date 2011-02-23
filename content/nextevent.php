<!--maincontent-->
<!--nextevent-->
<div class="grid_8">
<h1>Next Event</h1>
<?php
//includes
include "inc/config.php";
include "inc/functions.php";

// open database connection
//---------------------------------------------------------
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
//---------------------------------------------------------
mysql_select_db($db) or die ("Unable to select database!");

// generate and execute query for events and results
//---------------------------------------------------------
$query = "SELECT * FROM events WHERE up_id = '$up_id'"; // only selected event

// issue result set
//---------------------------------------------------------
$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

// if records present for events
//---------------------------------------------------------


$row = mysql_fetch_object($result);
echo $row->event;
echo nl2br($row->descrip);?>
<p>Directions:
<?
echo $row->location;
echo $row->contact;
?>
	<br />
<?php
			} // ending if for result
		} //ending while

	// if no records present
	// display message
	else
		{
	?>
	<p>No events listed</p> 
	<?
	}

	// close database connection
	// mysql_close($connection);
	?>
<!--/nextevent-->
<!--/maincontent-->