<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>CROC Admin Pages</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="../css/960.css" type="text/css" media="screen" title="no title" charset="utf-8">
<link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen" title="no title" charset="utf-8">

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript"> 
  var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
 
  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
</script> 
</head> 
<body onload="initialize()">
	<div class="container_12">
		<div class="grid_12 corners shadow scheduleDetails">		
		<h1>CROC Admin Pages</h1>
		<a href="../index.php">Return to site</a> | <a href="events_list.php">View Full List</a> | <a href="events_add.php">Add New Event</a> <hr />
		