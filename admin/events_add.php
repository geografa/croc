<?php

// includes
include 'header.php';
include '../inc/config.php';
include '../inc/functions.php';

$submit = $_POST[submit];

// open database connection and select database
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");
mysql_select_db($db) or die ("Unable to select database!");

if (empty($submit)) { ?>
	<form action="<? echo $PHP_SELF; ?>" method="POST">
		<div class="grid_11">
			
			<h4>Short Event Name</h4>
			<p>Short (25 chars or less) description with name and/or location (eg. Tryon Creek State Park, Portland, OR).</p>
			<input type="text" size="25" name="short_ev">
			
			<h4>Full Event Name</h4>
			<p>Longer more descriptive event name.</p>
			<input type="text" size="50" name="event">

			<h4>Event Date</h4>
			<p>*Important* Must be in this format: 0000-00-00 (Year, Month, Day)</p>
			<input type="text" size="25" name="date">

		<!-- TODO insert map locator here -->
			<h4>Venue!</h4>
			<select name="venue_id" id="venue_id">
				<option selected="selected"><? echo $eventrow->venue_name; ?></option>
				<?php
				$venuequery = "SELECT venue_id, venue_name
				 								FROM venues";
				$venueresult = mysql_query($venuequery) or die ("Error in query: $venuequery. " . mysql_error());
				while($venuerow = mysql_fetch_array($venueresult)) {
					echo '<option value="' . $venuerow['venue_id'] . '">' . $venuerow['venue_name'] . '</option>';
					}
					?>
			</select>
			<p>Venue not in the list? Add your venue <a href="events_add_venue.php">here.</a></p>
			
			<h4>Description</h4>
			<p>Full description here.</p>
			<textarea name="descrip" rows="8" cols="40"></textarea>
	
			<h4>Contact</h4>
			<p>Name, email, and phone (if you are comfortable with that.)</p>
			<input type="text" size="50" name="contact">
			</div>
				
			<input type="Submit" name="submit" value="Add Event">
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
		$short_ev = $_POST[short_ev];
		$event = $_POST[event];
		$date = $_POST[date];
		$venue_id = $_POST[venue_id];
		$descrip = $_POST[descrip];
		$contact = $_POST[contact];
		
		if (!$short_ev) { $errorList[$count] = "Invalid entry: Short Event"; $count++; }
		if (!$event) { $errorList[$count] = "Invalid entry: Event"; $count++; }
		if (!$date) { $errorList[$count] = "Invalid entry: Date"; $count++; }
		if (!$descrip) { $errorList[$count] = "Invalid entry: Description"; $count++; }
		if (!$venue_id) { $errorList[$count] = "Invalid entry: Venue"; $count++; }
		if (!$contact) { $errorList[$count] = "Invalid entry: Contact"; $count++; }
		// check for errors
		// if none found...
		if (sizeof($errorList) == 0)
		{
			
		// generate and execute query
		$query = "INSERT INTO events
		 					(short_ev, event, date, descrip, venue_id, contact )
							VALUES ( '$short_ev', '$event', '$date', '$descrip', '$venue_id', '$contact' )";
						
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