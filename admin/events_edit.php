<?php

// includes
include 'header.php';
include '../inc/config.php';
include '../inc/functions.php';

// open database connection and select database
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");
mysql_select_db($db) or die ("Unable to select database!");


// Fix the $up_id to get rid of register_globals problem
$up_id = $_GET[up_id];
$submit = $_POST[submit];

// form not yet submitted display initial form with values pre-filled

if (empty($submit)) {

// queries
	$eventquery = "SELECT * FROM events
									LEFT JOIN venues
									ON events.venue_id=venues.venue_id
									WHERE up_id = '$up_id'";
	$eventresult = mysql_query($eventquery) or die ("Error in query: $eventquery. " . mysql_error());
	

	
// if a result is returned start form
	if (mysql_num_rows($eventresult) > 0) {
		$eventrow = mysql_fetch_object($eventresult);
		?>

<form action="<? echo $PHP_SELF; ?>" method="POST">
	<input type="hidden" name="up_id"  value="<? echo $up_id; ?>">
	<div class="scheduleAdmin">
		  <p>Event - Short Description (on index)</p>
			<input type="text" size="30" name="short_ev" value="<? echo $eventrow->short_ev; ?>">
	</div>
	<div class="scheduleAdmin">
	  <p>Event Name with Location - (eg. Tryon Creek State Park, Portland, OR)</p> 
		<input type="text" size="100" name="event" value="<? echo $eventrow->event; ?>">
	</div>
	<div class="scheduleAdmin">
	  <p>Event Date - *Important* Must be in this format: 0000-00-00 (Year, Month, Day)</p>
		<input type="text" size="20" name="date" value="<? echo $eventrow->date; ?>">
	</div>
	<div class="scheduleAdmin">
	  <p>Description - type in here or just cut and paste your text. No fancy formatting or html tags please.</p>
		<textarea name="descrip" cols="100" rows="10"><? echo $eventrow->descrip; ?></textarea>
	</div>
	<div class="scheduleAdmin">
		<p>Venue</p>
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
		<p>Don't see your venue in the list? Add it <a href="events_add_venue.php">here.</a></p>
	</div>

	<div class="scheduleAdmin">
		<p>Contact (name, email, phone). This will help people contact you for volunteering.</p>
		<input size="50" maxlength="250" type="text" name="contact" value="<? echo $eventrow->contact; ?>">
	</div>
	<input type="Submit" name="submit" value="Update Event">
</form>
<?php
	}
// no result returned; print graceful error message
	else
		{
		echo "That record could not be located in our database.";
		}
}
// form submitted
// start processing it
else
{
	// fetch values set when Update button was hit
	$short_ev = $_POST[short_ev];
	$event = $_POST[event];
	$date = $_POST[date];
	$venue_id = $_POST[venue_id];
	$descrip = $_POST[descrip];
	$contact = $_POST[contact];

// set up error list array
	$errorList = array();
	$count = 0;

// validate text input fields
	
	if (!$short_ev) { $errorList[$count] = "Invalid entry: Short Event"; $count++; }
	if (!$event) { $errorList[$count] = "Invalid entry: Event"; $count++; }
	if (!$date) { $errorList[$count] = "Invalid entry: Date"; $count++; }
	if (!$venue_id) { $errorList[$count] = "Invalid entry: Venue"; $count++; }
	if (!$descrip) { $errorList[$count] = "Invalid entry: Description"; $count++; }
	if (!$contact) { $errorList[$count] = "Invalid entry: Contact"; $count++; }
	
// check for errors
// if none found...
	if (sizeof($errorList) == 0) {
		$updatequery = "UPDATE events
										SET short_ev = '$short_ev', 
										event = '$event', 
										date = '$date', 
										descrip = '$descrip', 
										venue_id = '$venue_id',
										contact = '$contact'
										WHERE up_id = '$up_id'";

		$updateresult = mysql_query($updatequery) or die ("Error in query: $updatequery. " . mysql_error()); ?>		
<p><? echo "Update successful.";?></p>
<?
	}
	else
	{
// errors occurred
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

// close database connection
mysql_close($connection);

?>
<!--  page footer  -->
	<hr>
	<ul>
  	<a href="events_list.php">Get back to the list.</a>
	</ul>
</body>
</html>
