<html>
<head>
<title>Welcome to the Columbia River Orienteering Club</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles/body.css" type="text/css">
<link rel="stylesheet" href="../styles/body.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" text="#333333" link="#666666" vlink="#666666" alink="#666666">
<!--  page header  -->
<?
include "../subpageheader/subpageheader.htm";
?>
<!--  page header stop -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="29">&nbsp; </td>
    <td class="txtArialBlack" align="left" valign="top" width="752"> 
	<br>
	<span class="plaintxt"><a href="results_add.php">add new</a></span>
	  <?
// includes
include("../config.php");
include("../functions.php");

// open database connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// generate and execute query
$rquery = "SELECT r_id, ev_result, r_date, r_desc FROM results WHERE r_date > '2010-12-31'";
$rresult = mysql_query($rquery) or die ("Error in query: $rquery. " . mysql_error());

// if records present
if (mysql_num_rows($rresult) > 0)
{
	// iterate through resultset
	// print title with links to edit and delete scripts
	while($rrow = mysql_fetch_object($rresult))
	{
	?>
		<p class="subtitle"> 
		
		<? echo $rrow->ev_result; ?>
		[ 
		<? echo formatdate($rrow->r_date);?>
		]
		
		</p>
	  <p class="plaintxt"> <a href="results_edit.php?r_id=<? echo $rrow->r_id;?>">edit</a> 
        | <a href="results_delete.php?r_id=<? echo $rrow->r_id;?>">delete</a> </p> 
		
	  <?
	}
}
// if no records present
// display message
else
{
?>
	  <span class="plaintxt">No records currently available </span> 
	  <p> 
		<?
}

// close connection
mysql_close($connection);
?>
		<span class="plaintxt"><a href="results_add.php">add new</a></span> 
		<!-- standard page footer begins -->
	</tr>
 
</table>
</body>
</html>



