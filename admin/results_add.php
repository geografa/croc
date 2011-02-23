<html>
<head>
<link rel="stylesheet" href="/styles/body.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" class="txtArialBlack" text="#333333" link="#666666" vlink="#666666" alink="#666666">
<!--  page header  -->
<?
include "../subpageheader/subpageheader.htm";

?>
<!--  page header stop -->
<?

// Fix the $submit to get rid of register_globals problem
$submit = $_POST[submit];

// form not yet submitted
// display initial form
if (empty($submit))
{
?>
<form action="<? echo $PHP_SELF; ?>" method="POST">
<blockquote>
    <table cellspacing="5" cellpadding="5" width="600" align="left" border="0" bordercolor="#CCCCCC">
      <tr align="left" valign="top"> 
        <td width="210" height="83"> 
          <div align="right" class="subtitle"> 
            <p>Event</p>
            <p class="plaintxt">Short Description (on index)</p>
          </div>
        </td>
        <td width="364" height="83"> 
          <input type="text" size="50" name="ev_result">
        </td>
        <td class="txtArialBlackBold" height="76">&nbsp;</td>
      </tr>
      <tr align="left" valign="top"> 
        <td width="210" class="subtitle"> 
          <div align="right" class="txtArialBlack"> 
            <p>Event Date</p>
            <p class="plaintxt">*Important* Must be in this format: 0000-00-00 
              (Year, Month, Day)</p>
          </div>
        </td>
        <td width="364"> 
          <input type="text" size="50" name="r_date" >
        </td>
        <td class="txtArialBlackBold" height="76">&nbsp;</td>
      </tr>
      <tr align="left" valign="top"> 
        <td width="210" class="subtitle"> 
          <div align="right"> 
            <p>Results</p>
            <p class="plaintxt"><span class="plaintxt">(Sorry, no carriage returns 
              yet, format your content in notepad with a fixed width font like 
              Courier.)</span></p>
          </div>
        </td>
        <td width="364"> 
          <textarea name="r_desc" cols="50" rows="10" wrap="OFF"></textarea>
        </td>
        <td class="txtArialBlackBold" height="76">&nbsp;</td>
      </tr>
      <tr align="left" valign="top"> 
        <td width="210" class="subtitle"> 
          <input type="Submit" name="submit" value="Add">
        </td>
        <td width="364">&nbsp;</td>
        <td height="34">&nbsp;</td>
      </tr>
    </table>
  </blockquote>
</form>

<p class="txtArialBlack">
<?

//------------------------------The results are set here----------------------

}
else
{
	// includes
	include("../config.php");
	
	// set up error list array
	$errorList = array();
	$count = 0;
	
	
?>
<br>
<?

	// fetch values set when Update button was hit
	$ev_result = $_POST[ev_result];
	$r_date = $_POST[r_date];
	$r_desc = $_POST[r_desc];

	// validate text input fields
	
	if (!$ev_result) { $errorList[$count] = "Invalid entry: Event - Short Description"; $count++; }
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
		$query = "INSERT INTO results ( ev_result, r_desc, r_date ) VALUES ( '$ev_result', '$r_desc', '$r_date' )";


$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

		// print result
		
?>

<blockquote class="plaintxt"> 
  <?
		echo "Update successful. <a href=results_list.php>Go back to the main menu</a>.";

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
</blockquote>
<!--  page footer  -->
  
<!--  page footer stop -->


</body>
</html>