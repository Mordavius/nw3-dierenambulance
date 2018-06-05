var app = angular.module("app", [])
.controller("TableController", ['$scope','$http', function($scope, $http){

    $scope.distance = [];
    $scope.map = L.map("map", {
    center: [53, 5.7],
    zoom: 10,
    });
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
    if(page1.className == "pages current_page"){
        page1.className = "pages";
        page2.className = "pages current_page";
        map.style.height = "400px";
        $scope.map.setView([53.1, 5.6], 10)
        $scope.map.invalidateSize();
        setTimeout(function(){

        }, 300);

    } else if (page2.className == "pages current_page") {
        page2.className = "pages";
        page1.className = "pages current_page";
    }
}
}])
