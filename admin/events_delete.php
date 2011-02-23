<?
include 'header.php';
include '../inc/config.php';
include '../inc/functions.php';

// open database connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// Fix the $up_id to get rid of register_globals problem
$up_id = $_GET[up_id];

// generate and execute query
$query = "DELETE FROM events WHERE up_id = '$up_id'";
$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

// close database connection
mysql_close($connection);

// print result
?><p class="scheduleAdmin">
<?php
echo "Deletion successful. <a href=events_list.php>Go back to the list</a>.";
?>
</p>
</blockquote>
</body>
</html>
