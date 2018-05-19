var app = angular.module("app", [])
.controller("TableController", ['$scope','$http', function($scope, $http){

    $scope.distance = [];
    $scope.map = L.map('map').setView([53, 5.7], 10);
	$scope.coordinates = [];

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> Contributors',
        maxZoom: 30,
        minZoom: 1,
    }).addTo($scope.map);

	var coords = $('#map').data('coordinates')
	coords.forEach(function(coord){
		placeMarker(coord);
	})

	function placeMarker(i){
		var latlng = L.latLng(i.lat, i.lng);
		var marker = L.marker(latlng).addTo($scope.map);
        $scope.distance.push(latlng);
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

$('#toggle-button').click(toggle);
var img_array_map= new Array('images/map-view.png','images/map-view-active.png');
var img_array_list= new Array('images/list-view-active.png','images/list-view.png');
var i = 0;

function toggle () {
    i++;
    document.getElementById("map-image").src=img_array_map[i];
    document.getElementById("list-image").src=img_array_list[i];
    if(i==img_array_map.length-1) {
        i=-1;
    }
    if(target.style.display === "none"){
        target2.className = "grid-container slideOutLeft animated";
        target.className = "grid-container slideInRight animated";
        setTimeout(function()
        {
            target2.style.display = "none";
            target.style.display = "block";},
            1000);
    } else {
        target.className = "grid-container slideOutRight animated";
        target2.className = "grid-container slideInLeft animated";
        setTimeout(function(){
            target.style.display = "none";
            target2.style.display = "block";
            map.style.height = "400px";
            $scope.map.setView([53.03, 5.7], 10);
            $scope.map.invalidateSize();},
            1000);
    }
}
}])
