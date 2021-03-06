$(document).ready(function(){

(function(){

	var map;
	map = new GMaps({
		el: '#myMap',
		lat: 15.0395021,
		lng: 102.1070984,
		scrollwheel:false,
		zoom: 15,
		zoomControl : false,
		panControl : false,
		streetViewControl : true,
		mapTypeControl: false,
		overviewMapControl: false,
		clickable: false,
		 panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true,
            fullscreenControl: true,
	});

	var image = '../images/map-marker.png';
	map.addMarker({
		lat: 15.0395021,
		lng: 102.1070984,
		icon: image,
		animation: google.maps.Animation.DROP,
		verticalAlign: 'bottom',
		horizontalAlign: 'left',
		backgroundColor: '#efece0',
	});
	

	/*var styles = [

		{
			"featureType": "road",
			"stylers": [
				{ "color": "#ffffff" }
			]
		},{
			"featureType": "water",
			"stylers": [
				{ "color": "#bde5f6" }
			]
		 },{
		  "featureType": "landscape",
			 "stylers": [
			 { "color": "#faf5e8" }
			 ]
		},{
			"elementType": "labels.text.fill",
			"stylers": [
				{ "color": "#a8a8a8" }
			]
		},{
			"featureType": "poi",
			"stylers": [
			 { "color": "#e2f0cd" }
			]
		},{
			"elementType": "labels.text",
			"stylers": [
				{ "saturation": 1 },
				{ "weight": 0.1 },
				{ "color": "#a8a8a8" }
			]
		}

	];*/

	 map.addStyle({
		styledMapName:"Styled Map",
		/*styles: styles,*/
		mapTypeId: "map_style"
	});

	map.setStyle("map_style");
}());

});