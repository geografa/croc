<!-- cloudmade script -->
<script type="text/javascript" src="http://tile.cloudmade.com/wml/latest/web-maps-lite.js"></script>

<!-- Add static maps based on location (lat/long) -->
<?php
//includes
include "inc/config.php";
include "inc/functions.php";

// open database connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// generate and execute query for events and results
$query = "SELECT *
					FROM events
					LEFT JOIN venues
					ON events.venue_id=venues.venue_id
					WHERE events.date > now() AND date < '2011-04-31' ORDER BY date ASC LIMIT 20"; // only show 10 2011 events

// issue result set
$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

// if records present for events
if (mysql_num_rows($result) > 0)
	{
// iterate through resultset and list upcoming events
	while($row = mysql_fetch_object($result))
		{
?>
<div class="scheduleDetails">
	<p class="scheduleTitle">
		<a name="<?php echo $row->up_id;?>"></a>
		<?php
		// List events, date, description, and map
		echo $row->short_ev;
		?>
		<span class="scheduleDate"><?echo formatdate($row->date);?></span>
	</p>			
	<p>
	<?php
	echo "Meet Director: ".$row->contact."<br />";
	echo $row->descrip."<br />";
	?>
	<img id="cm-inset" src="http://maps.google.com/maps/api/staticmap?center=<?echo $row->latlong; ?>&zoom=12&size=640x300&markers=icon:http://grafa.co/croc/img/CROC_smlogo.gif%7C<?echo $row->latlong; ?>&sensor=false" />
	</p>
</div>
	<?php
			} // ending if for result
		} //ending while

	// if no records present
	// display message
	else
		{
	?>
	<p>No events listed</p> 
	<?php
	}

	// close database connection
	// mysql_close($connection);
	?>