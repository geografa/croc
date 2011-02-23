<html>
<head>

<title>Admin</title>
<link rel="stylesheet" href="/styles/txt.css" type="text/css">
<link rel="stylesheet" href="/styles/body.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" text="#333333" link="#666666" vlink="#666666" alink="#666666">
<!--  page header  -->
<?
include "../subpageheader/subpageheader.htm";
?>
<!--  page header stop -->
<?

// includes
include("../config.php");
include("../functions.php");
//--------------------------------------------------------------------------------------------------

// Fix these up to get rid of register_globals problem
$submit = $_POST[submit];
$r_id = $_GET[r_id];

// form not yet submitted
// display initial form with values pre-filled

if (empty($submit))
{
	
// open database connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// generate and execute query
$rquery = "SELECT r_id, ev_result, r_date, r_desc FROM results WHERE r_id = '$r_id'";



$rresult = mysql_query($rquery) or die ("Error in query: $rquery. " . mysql_error());
	
	//--------------------------------------------------------------------------------------------------
	// if a result is returned start form
	if (mysql_num_rows($rresult) > 0)
	{
		// turn it into an object
		$rrow = mysql_fetch_object($rresult);

		// print form with values pre-filled
?>
<form action="<? echo $PHP_SELF; ?>" method="POST">
    <input type="hidden" name="r_id"  value="<? echo $r_id; ?>">
		
  <table cellspacing="5" cellpadding="5" width="611">
	<tr> 
	  <td valign="top" width="210" height="83"> 
		<div align="right" class="subtitle"> 
		  <p>Event</p>
		  <p class="plaintxt">Short Description (on index)</p>
		</div>
	  </td>
	  <td width="364" align="left" valign="top" height="83"> 
		<input type="text" size="50" name="ev_result" value="<? echo $rrow->ev_result; ?>">
	  </td>
	</tr>
	<tr> 
	  <td valign="top" width="210" class="subtitle"> 
		<div align="right" class="txtArialBlack"> 
		  <p>Event Date</p>
		  <p class="plaintxt">*Important* Must be in this format: 0000-00-00 (Year, 
			Month, Day)</p>
		</div>
	  </td>
	  <td width="364" align="left" valign="top"> 
		<input type="text" size="50" name="r_date" value="<? echo $rrow->r_date; ?>">
	  </td>
	</tr>
	<tr> 
	  <td valign="top" width="210" class="subtitle"> 
		<div align="right"> 
		  <p>Results</p>
		  <p class="plaintxt"><span class="plaintxt">(Use courier font as it is 
			a fixed width font and will maintain tabs.)</span></p>
		</div>
	  </td>
	  <td width="364" align="left" valign="top"> 
		<textarea name="r_desc" cols="50" rows="20" wrap="OFF"><? echo $rrow->r_desc; ?></textarea>
	  </td>
	</tr>
	<tr> 
	  <td colspan=2> 
		<input type="Submit" name="submit" value="Update">
	  </td>
	</tr>
	<tr> 
	  <td colspan=2>&nbsp;</td>
	</tr>
  </table>
</form>
<?
		}
	// no result returned
	// print graceful error message
	else
		{
		echo "That record could not be located in our database.";
		}
}
// form submitted
// start processing it
else
{
	
	// set up error list array
	$errorList = array();
	$count = 0;

	// fetch values set when Update button was hit
	$ev_result = $_POST[ev_result];
	$r_date = $_POST[r_date];
	$r_desc = $_POST[r_desc];

	
	// validate text input fields
	
	if (!$ev_result) { $errorList[$count] = "Invalid entry: Event"; $count++; }
	if (!$r_date) { $errorList[$count] = "Invalid entry: Date"; $count++; }
	if (!$r_desc) { $errorList[$count] = "Invalid entry: Results"; $count++; }
	
		
	// check for errors
	// if none found...
	if (sizeof($errorList) == 0)
	{
		// open database connection
		$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

		// select database
		mysql_select_db($db) or die ("Unable to select database!");

		// generate and execute query
			
		$query = "UPDATE results SET  ev_result = '$ev_result', r_desc = '$r_desc', r_date = '$r_date'   WHERE r_id = '$r_id'";
		
		$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

		// print result
?>		
<blockquote class="plaintxt">

		<? echo "Update successful.";?>

</blockquote>
<?
		// close database connection
		mysql_close($connection);
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
?>
<!--  page footer  -->
	<hr>
	<ul class="plaintxt">
  	<a href="results_list.php">Get back to the list.</a>
	</ul> <br>
<!--  page footer stop -->

</body>
</html>