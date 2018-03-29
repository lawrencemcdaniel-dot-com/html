jQuery(document).ready(function() {

    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
		jQuery(".map-canvas").each(function() {

			var LocTitle = jQuery(this).attr('data-loctitle');
			var LocDesc = jQuery(this).attr('data-locdesc');
			var IconBase = jQuery(this).attr('data-base');
			var LatValue = jQuery(this).attr('data-lat');
			var LngValue = jQuery(this).attr('data-lng');
			var GetID = jQuery(this).attr('id');
			var myLatLng = new google.maps.LatLng(LatValue,LngValue);
			/*var roadAtlasStyles = [ { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#474D5D" } ] },{ "elementType": "labels.text.fill", "stylers": [ { "color": "#FFFFFF" } ] },{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" } ] },{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#50525f" } ] },{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ] },{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },{ "featureType": "transit", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] },{ "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#808080" } ] },{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#3071a7" }, { "saturation": -65 } ] },{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] },{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "color": "#bbbbbb" } ] } ];*/
			var roadAtlasStyles = [ { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [{ visibility: "off" }]}];
			var styledMap = new google.maps.StyledMapType(roadAtlasStyles,{name: "Styled Map"});
			
			var mapOptions = {
				zoom: 14,
				center: myLatLng,
				disableDefaultUI: true,
				scrollwheel: false,
				navigationControl: false,
				mapTypeControl: false,
				scaleControl: false,
				draggable: false,
				mapTypeControlOptions: {
				  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
				}
			  };
			
			var map = new google.maps.Map(document.getElementById(GetID), mapOptions);
		  
		   	var marker = new google.maps.Marker({
			  position: myLatLng,
			  map: map,
			  icon: IconBase + '/images/location-icon.png',
			  title: '',
			});
		
		var contentString = '<div style="max-width: 300px" id="content">'+
			  '<div id="bodyContent">'+
			  '<h4>' + LocTitle + '</h4>' +
			  '<p style="font-size: 12px">' + LocDesc + '</p>'+
			  '</div>'+
			  '</div>';

		  var infowindow = new google.maps.InfoWindow({
			  content: contentString
		  });

		  
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		  });

		  var styledMapOptions = {
			name: 'US Road Atlas'
		  };

		  var usRoadMapType = new google.maps.StyledMapType(
			  roadAtlasStyles, styledMapOptions);
		
		map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');	

			
		});
        
    }

});