<!-- cloudmade script -->
<script type="text/javascript" src="http://tile.cloudmade.com/wml/latest/web-maps-lite.js"></script>

<!-- Add static maps based on location (lat/long) -->
<?php
//includes
include "../inc/config.php";
include "mapheader.php";

// open database connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// generate and execute query for events and results
$query = "SELECT *
					FROM venues"; //

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
		<a name="<?php echo $row->venue_id;?>"></a>
		<?php
		echo $row->venue_name;
		?>
	</p>			
	<img id="cm-inset" src="http://staticmaps.cloudmade.com/8ee2a50541944fb9bcedded5165f09d9/staticmap?center=<?echo $row->latlong; ?>&zoom=11&size=800x300&format=png&styleid=997" alt="Map">
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