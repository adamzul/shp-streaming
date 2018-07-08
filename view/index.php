<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="map" style="width:800px;height:500px">My map will go here</div>
	<button onclick="loadGeoJson('SBYkecamatan_Populasi')">kecamatan</button>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	// Initialize and add the map
	var map, features = [];
	function initMap() {
	  // The location of Uluru
	  var uluru = {lat: -7.2767655, lng: 112.7227931};
	  // The map, centered at Uluru
	  map = new google.maps.Map(
	      document.getElementById('map'), {zoom: 12, center: uluru});
	  // NOTE: This uses cross-domain XHR, and may not work on older browsers.
	}
	function loadGeoJson(param){
		// map.data.loadGeoJson('http://localhost:8000/api/'+param);
		if(param in features){
			for (var i = 0; i < features[param].length; i++)
	    		map.data.remove(features[param][i]);
	    	delete features[param];
		}
		else{
				$.getJSON('http://'+window.location.hostname+':'+window.location.port+'/api/'+param, 
					function (data){
			  			features[param] = map.data.addGeoJson(data);
				});
		}
		
	}
	

	</script>
	<script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPM_V_FOf2tUmHqIMbE70GKta_ijlIgTU&callback=initMap">
	</script> 
</body>
</html>