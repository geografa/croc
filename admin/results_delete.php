<?
/*
All source code copyright and proprietary Melonfire, 2002. All content, brand names and trademarks copyright and proprietary Melonfire, 2002. All rights reserved. Copyright infringement is a violation of law.

This source code is provided with NO WARRANTY WHATSOEVER. It is produced and meant for illustrative purposes only, and is NOT recommended for use in production environments. 

Read more articles like this one at http://www.melonfire.com/community/columns/trog/ and http://www.melonfire.com/
*/

// results delete.php - delete a result
?>
<html>
<head>
<title>CROC Admin</title>
<link rel="stylesheet" href="../styles/body.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" class="txtArialBlack" text="#000000" link="#666666" vlink="#666666" alink="#666666">
<span class="links"> 
<!--  page header  -->
<?
include "../subpageheader/subpageheader.htm";
?>
<!--  page header stop -->
</span> 
<blockquote> 
  <p class="txtArialBlack"> <span class="links">
    <?
// includes
include("../config.php");
include("../functions.php");

// Fix the $r_id to get rid of register_globals problem
$r_id = $_GET[r_id];

// open database connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// generate and execute query
$query = "DELETE FROM results WHERE r_id = '$r_id'";
$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

// close database connection
mysql_close($connection);

// print result
echo "Deletion successful. <a href=results_list.php>Go back to the list</a>.";
?>
    <!--  page footer  -->
    <!--  page footer stop -->
    </span></p>
</blockquote>
</body>
</html>