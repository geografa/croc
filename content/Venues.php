<!-- cloudmade script -->
<script type="text/javascript" src="http://tile.cloudmade.com/wml/latest/web-maps-lite.js"></script>

<!--> Add static maps based on location (lat/long)<-->
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

<!-- <div id="cm-map"></div>

<script type="text/javascript">

//set the CM variables and make the map
var cloudmade = new CM.Tiles.CloudMade.Web({key: '82fe27f98a6044c280c7687504af705e'});
var map = new CM.Map('cm-map', cloudmade);
map.setCenter(new CM.LatLng(45.5734, -122.6557), 15);

//make new var for KML data
var geoxml = new CM.GeoXml('http://grafa.co/croc/kml/Oregon-Humanities-Programs.kml');

//make markers for GeoXML
CM.Event.addListener(geoxml, 'load', function() {
	map.zoomToBounds(geoxml.getDefaultBounds());
	map.addOverlay(geoxml);
});

//sidebar control for styling CM maps. If used, add button:
//<button onclick="map.toggleSidebar();">Toggle Style Sidebar<button>
//var sidebar = new CM.StyleSidebar({key: '82fe27f98a6044c280c7687504af705e'});
//map.setSidebar(sidebar);
//map.openSidebar();
</script> -->