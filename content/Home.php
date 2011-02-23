<!--home-->
<div class="grid_7 main">
	<div class="copy">
		<h1 class="head">Adventure Anyone?</h1>
			<img class="monthly"src="img/omap_small.jpg" width="287" height="240" alt="Orienteering Map" align="left">
			<p>Orienteering is a cross country activity where participants use a detailed map and a compass to navigate through a set course in the surrounding terrain. There are also events that take place in the city where participants navigate through local parks. Most events have a variety of courses varying from short and easy (2km) to long and navigationally demanding (up to 15km). The Columbia River Orienteering Club typically holds one to two meets a month in the greater Portland/Vancouver area. Families, Scout groups, runners, walkers, adventure racers - all are welcome!</p>

			<p>Orienteering is a family of sports that requires navigational skills using a map and compass to navigate from point to point in diverse and usually unfamiliar terrain, and normally moving at speed. Participants are given a topographical map, usually a specially prepared orienteering map, which they use to find control points.[1] Originally a training exercise in land navigation for military officers, orienteering has developed many variations. Among these, the oldest and the most popular is foot orienteering. For the purposes of this article, foot orienteering serves as a point of departure for discussion of all other variations, but basically any sport that involves racing against a clock and requires navigation using a map is a type of orienteering.</p>
	</div><!-- .copy -->
</div>
<div class="grid_5 side"><!--schedule-->
	<div class="copy">
		<h1>2011 Schedule</h1>	
			<?php
			//includes
			include "inc/config.php";
			include "inc/functions.php";
			?>

			<?php
			// open database connection
			$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

			// select database
			mysql_select_db($db) or die ("Unable to select database!");

			// generate and execute query for events and results
			$query = "SELECT * FROM events WHERE date > now() AND date < '2011-12	-31' ORDER BY date ASC"; // only show 20 2011 events

			$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

			// if records present for events
			if (mysql_num_rows($result) > 0)
				{
			// iterate through resultset
			// list upcoming events

				while($row = mysql_fetch_object($result))
					{
			?>

			<ul>
				<li class="schedule">
					<a href="index.php?page=schedule#<? echo $row->up_id; ?>">
						<?php echo formatdate($row->date);?> - 
						<?php echo $row->short_ev;?>
					</a>
				</li>
			</ul>
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
			<hr /><img src="img/pdf.jpg" width="36" height="36" alt="Pdf"><p>Download the <a href="#" class="links">full 2011 schedule</a>.</p>
	</div><!-- .copy -->		
</div><!--/schedule-->