	<div class="grid_9">
		<h1>Training</h1>
		
		<div id="message">Drag or click the map for coordinates.</div>
	 	<div id="cm-map"></div>

	  <script type="text/javascript" src="http://tile.cloudmade.com/wml/latest/web-maps-lite.js"></script>
	  <script type="text/javascript">
	
			var cm_key = '82fe27f98a6044c280c7687504af705e'
	    var cloudmade = new CM.Tiles.CloudMade.Web({key: cm_key, styleId: 1714});
			var sidebar = new CM.StyleSidebar({key: cm_key});
			var map = new CM.Map('cm-map', cloudmade);
			
			map.setCenter(new CM.LatLng(45.5727, -122.6546), 13);
			map.addControl(new CM.LargeMapControl());
			map.addControl(new CM.ScaleControl());
//			map.addControl(new CM.OverviewMapControl());
			
			map.setSidebar(sidebar);
			map.closeSidebar();
			
						
			function displayMessage(msg) {
				document.getElementById('message').innerHTML = msg;
			}

			CM.Event.addListener(map, 'click', function(latlng) {
				displayMessage("You have clicked the map at " + latlng.toString(4));
			});

			CM.Event.addListener(map, 'dragend', function() {
				displayMessage(map.getCenter().toString(4));
			});
			
	  </script>