<?php

// includes
include 'mapheader.php';
include '../inc/config.php';
include '../inc/functions.php';

$submit = $_POST[submit];

// open database connection and select database
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");
mysql_select_db($db) or die ("Unable to select database!");

if (empty($submit)) { ?>
	<form action="<? echo $PHP_SELF; ?>" method="POST" name="VenueForm">
		<div class="grid_11">
			<div class="scheduleAdmin">
				<div>							
						<a href="#" onMouseOver="updateLocation()">
							<div id="map_canvas" style="width:100%; height:400px"></div> 	
						</a>

						<div id="crosshair"></div>
						
				    <h4>Step 1. Type your venue's address: </h4><input type="text" size="60" id="address" tabindex="1" />
						<input type="button" value="search" id="search" onclick="geocode()" tabindex="2" />

						<div class="scheduleDate">Current coordinates: </div>
						<div id="latlng"></div>						
							<input type="hidden" name="latlong" />
					 	<div id="formatedAddress"></div>
						
						<input type="hidden" name="venue_address" />

						<h4>Step 2. Provide a short name for the venue: <a href="#" onchange="updateAddress()" ><input type="text" size="50" name="venue_name" id="venue_name" tabindex="3" /></a></h4>
					</div>
				<input type="Submit" value="Add Location" id="submit" name="submit" tabindex="4" />
			</div>
			<div>
					<!-- <input type="Submit" name="submit" value="Add"> -->
			</div>
	</form>
<?php
//--The results are set here--
	}
	else
	{
		// TODO - fix error handling here
		$errorList = array();
		$count = 0;
		// validate text input fields
		// fetch values set when Add button is hit
		$venue_name = $_POST[venue_name];
		$venue_address = $_POST[venue_address];
		$latlong = $_POST[latlong];
		
		if (!$venue_name) { $errorList[$count] = "Invalid Entry: You need to supply a short name."; $count++; }
		if (!$venue_address) { $errorList[$count] = "Invalid entry: Venue Address"; $count++; }
		if (!$latlong) { $errorList[$count] = "Invalid entry: LatLong"; $count++; }
		// check for errors
		// if none found...
		if (sizeof($errorList) == 0)
		{
			
		// generate and execute query
		$query = "INSERT INTO venues
		 					(venue_id, venue_name, venue_address, latlong)
							VALUES ( '$venue_id', '$venue_name', '$venue_address', '$latlong' )";
						
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());
		
		// print result
		echo "Update successful. <a href=events_list.php>Go back to the main menu</a>.";

		// close database connection
		mysql_close($connection);
		}
		else
		{
			// errors found
			// print as list
			echo "The following errors were encountered: <br>";
			echo "<ul class=\"links\">";
			for ($x=0; $x<sizeof($errorList); $x++)
			{
				echo "<li>$errorList[$x]";
			}
			echo "</ul>";
		}
	}
?>
			</div><!--/grid_12-->
	</div><!--/container_12-->
</body>
</html>