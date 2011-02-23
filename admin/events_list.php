	<?php
	// includes
	include("header.php");
	include("../inc/config.php");
	include("../inc/functions.php");

	// open database connection
	$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

	// select database
	mysql_select_db($db) or die ("Unable to select database!");

	// generate and execute query
	$query = "SELECT up_id, short_ev, date
						FROM events
						WHERE date > now() AND date < '2011-08-31' ORDER BY date ASC LIMIT 20"; // only show 10 2011 events
						
	$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

	// if records present
	if (mysql_num_rows($result) > 0)
	{
		// iterate through resultset
		// print title with links to edit and delete scripts
		while($row = mysql_fetch_object($result))
		{
		?>
			<p class="scheduleTitle">
				<a name="<?php echo $row->up_id;?>"></a>
				<?php
				// List events, date, description, and map
				echo $row->short_ev;
				?>
				<span class="scheduleDate">
				<?echo formatdate($row->date);?>
				</span></p>
				<a href="events_edit.php?up_id=<? echo $row->up_id; ?>">edit</a> | <a href="events_delete.php?up_id=<? echo $row->up_id; ?>">delete</a>	<hr />	
		  <?
		}
	}
	// if no records present
	// display message
	else
	{
	?>
		  <p>No records currently available </p> 
	  
			<?
	}

	// close connection
	mysql_close($connection);
	?>
			<p><a href="events_add.php">add new</a></p> 
			<!-- standard page footer begins -->
		</div><!--/grid_12-->
	</div><!--/container-->
</body>
</html>