var map;
var geocoder;
var centerChangedLast;
var reverseGeocodedLast;
var currentReverseGeocodeResponse;

function initialize() {
  var latlng = new google.maps.LatLng(45.6,-122.6);
  var myOptions = {
    zoom: 12,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  geocoder = new google.maps.Geocoder();
 	setupEvents();
  centerChanged();
}

function setupEvents() {
  reverseGeocodedLast = new Date();
  centerChangedLast = new Date();
  setInterval(function() {
    if((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) {
      if(reverseGeocodedLast.getTime() < centerChangedLast.getTime())
        reverseGeocode();
    }
  }, 1000);
  google.maps.event.addListener(map, 'center_changed', centerChanged);
  google.maps.event.addDomListener(document.getElementById('crosshair'),'dblclick', function() {
     map.setZoom(map.getZoom() + 1);
  });
}

function updateLocation() {
  var latlng = map.getCenter().lat() +', '+ map.getCenter().lng();
  // var address = document.getElementById("address").value;

	venueForm = document.forms['VenueForm'];
	venueForm.elements["latlong"].value = latlng;	
	// venueForm.elements["address"].value = formatedAddress;
}

function getCenterLatLngText() {
  return '(' + map.getCenter().lat() +', '+ map.getCenter().lng() +')';
}

function centerChanged() {
  centerChangedLast = new Date();
  var latlng = getCenterLatLngText();
  document.getElementById('latlng').innerHTML = latlng;
  document.getElementById('formatedAddress').innerHTML = '';
  currentReverseGeocodeResponse = null;
}

function reverseGeocode() {
  reverseGeocodedLast = new Date();
  geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult);
}

function reverseGeocodeResult(results, status) {
  currentReverseGeocodeResponse = results;
  if(status == 'OK') {
    if(results.length == 0) {
      document.getElementById('formatedAddress').innerHTML = 'None';
    } else {
      document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
    }
  } else {
    document.getElementById('formatedAddress').innerHTML = 'Error';
  }
}

function geocode() {
  var address = document.getElementById("address").value;
  geocoder.geocode({
    'address': address,
    'partialmatch': true}, geocodeResult);
}

function geocodeResult(results, status) {
  if (status == 'OK' && results.length > 0) {
    map.fitBounds(results[0].geometry.viewport);
  } else {
    alert("Geocode was not successful for the following reason: " + status);
  }
}

function addMarkerAtCenter() {
  var marker = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
			icon: '../img/CROC_logo.gif'
  });

  var text = 'Lat/Lng: ' + getCenterLatLngText();
  if(currentReverseGeocodeResponse) {
    var addr = '';
    if(currentReverseGeocodeResponse.size == 0) {
      addr = 'None';
    } else {
      addr = currentReverseGeocodeResponse[0].formatted_address;
    }
    text = text + '<br>' + 'address: <br>' + addr;
  }

  var infowindow = new google.maps.InfoWindow({ content: text });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}