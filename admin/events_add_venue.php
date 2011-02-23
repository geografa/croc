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
	<form action="<? echo $PHP_SELF; ?>" method="POST">
		<div class="grid_11">
		<!-- TODO insert map locator here -->
			<div class="scheduleAdmin">
				<h4>Venue Name</h4>
				<input type="text" size="50" name="venue_name">	
			</div>			
			<div class="scheduleAdmin">
				<h4>Address</h4>
				<input type="text" size="60" name="address">
			</div>
			<div> 
		    <input id="address" type="textbox" value="Portland, OR"> 
		    <input type="button" value="Geocode" onclick="codeAddress()"> 
		  </div> 
			<div id="map_canvas" style="height:100"></div>
		
			<input type="Submit" name="submit" value="Add">
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
		$latlong = $_POST[latlong];

		
		if (!$venue_name) { $errorList[$count] = "Invalid entry: venue name"; $count++; }
		if (!$latlong) { $errorList[$count] = "Invalid entry: Lat Long"; $count++; }
		// check for errors
		// if none found...
		if (sizeof($errorList) == 0)
		{
			
		// generate and execute query
		$query = "INSERT INTO venues
		 					(venue_id, venue_name, latlong )
							VALUES ( '$venue_id', '$venue_name', '$latlong' )";
						
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
			echo "<ul>";
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