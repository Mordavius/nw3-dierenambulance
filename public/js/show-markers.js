var app = angular.module("app", [])
.controller("TableController", ['$scope','$http', function($scope, $http){

    $scope.distance = [];
    $scope.map = L.map('map').setView([53, 5.7], 10);
	$scope.coordinates = [];

    L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> Contributors',
        maxZoom: 30,
        minZoom: 1
    }).addTo($scope.map);

	var coords = $('#map').data('coordinates')
	coords.forEach(function(coord){
		placeMarker(coord);
	})

	function placeMarker(i){
		var latlng = L.latLng(i.lat, i.lng);

		var marker = L.marker(latlng).addTo($scope.map);
        $scope.distance.push(latlng);
        console.log(latlng.distanceTo($scope.distance[0]));
	}
    // use defaults
var line = L.polyline(coords);

// override defaults
var line = L.polyline(coords, {
	distanceMarkers: { showAll: 11, offset: 1600, cssClass: 'some-other-class', iconSize: [1, 1] }
});

// show/hide markers on mouseover
var line = L.polyline(coords, {
	distanceMarkers: { lazy: true }
});
$scope.map.fitBounds(line.getBounds());
$scope.map.addLayer(line);
}])
