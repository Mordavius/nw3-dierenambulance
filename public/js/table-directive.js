var app = angular.module("app", [])
.controller("TableController", ['$scope','$http', function($scope, $http){


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
	}

	function onMapClick(e) {
		makeRequest("GET", reverseGeocodeQuery("json", e.latlng.lat, e.latlng.lng, 18), function(err, result) {
			if(err) { throw err; }
			var marker = L.marker(e.latlng).addTo($scope.map);
			console.log(e.latlng);
			var obj = JSON.parse(result);
			updateAddressInformation(obj);
			})
	}

	function reverseGeocodeQuery(format, lat, lon, zoom) {
			var url = "https://nominatim.openstreetmap.org/reverse?format=" + format + "&lat=" + lat + "&lon=" + lon + "&zoom=" + zoom + "&addressdetails=1";
			console.log(url);
			return url;
	}

	function makeRequest (method, url, done) {
		var xhr = new XMLHttpRequest();

		xhr.open(method, url);

		xhr.onload = function() {
			done(null, xhr.response);
		}

		xhr.onerror = function() {
			done(xhr.response);
		}

		xhr.send();
	}

	function updateAddressInformation(obj){
		document.getElementById("postal_code").value = obj.address.postcode ? obj.address.postcode : "Kan postcode niet vinden";
		document.getElementById("house_number").value = obj.address.house_number ? obj.address.house_number : "";
		document.getElementById("address").value = obj.address.road ? obj.address.road : "Straatnaam onbekend"
		document.getElementById("city").value = obj.address.suburb ? obj.address.suburb : "Kan stad niet vinden";
		document.getElementById("township").value = obj.address.city ? obj.address.city : "Kan gemeente niet vinden";
	}
	$scope.map.on('click', onMapClick);

<<<<<<< HEAD

    var locationId =  Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
=======
>>>>>>> 15182f4c7447e578809c1552ae12c0d945574e40

	$('#searchButton').click(searchButtonClicked);

	function searchButtonClicked(){
		var searchText = document.getElementById("searchTextBox").value;
		makeRequest("GET", geocodeQuery(searchText, "json"), function(err, result) {
			if(err) { throw err; }

		var searchedURLJson = JSON.parse(result);
		//console.log(searchedURL);
		setMarkerForLocation(searchedURLJson);
		})
	}

	function geocodeQuery(searchText, format) {
		var searchedURL = "https://nominatim.openstreetmap.org/search/nl/" + searchText + "?format=json&addressdetails=1";
		return searchedURL;
	}

	function setMarkerForLocation(searchedURLJson) {
		var searchedLat = searchedURLJson[0].lat;
		var searchedLon = searchedURLJson[0].lon;

		//var marker = L.marker({lat: searchedLat, lng: searchedLon}).addTo($scope.map);

		$scope.map.setView(new L.LatLng(searchedLat, searchedLon), 15);
	}

<<<<<<< HEAD

    function getLocation() {
        if (navigator.geolocation) navigator.geolocation.getCurrentPosition(showPosition);
    }

    function showPosition(position) {
        $.ajax({
            type: 'POST',
            url: '/api/location/write',
            data: {lat: position.coords.latitude, lon: position.coords.longitude, id: id},
            success: function () {
                alert("succes");
            }

        });
    }

    function getLocationRecord(){
        $.ajax({
            type: 'GET',
            url: '/api/location/show/'+ locationId,
            success: function (data) {
                if (data === 'no location') {
                    setTimeout(function () {getLocationRecord()}, 3000);
                } else {

                    document.getElementById('coordinates').value = data;

                    data = JSON.parse(data);
                    getAdressByCoordinates(data.lat, data.lon);
                }
            }
        });
    }

    /**
     * get address by lat lon (from openstreetmap)
     * @param lat
     * @param lon
     */
    function getAdressByCoordinates(lat,lon){
        $.ajax({
            type: 'GET',
            url: 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lon + '&zoom=18&addressdetails=1',
            success: function (data) {
                if(data.address && data.display_name) {
                    if (data.address.house_number &&
                        data.address.road &&
                        data.address.city &&
                        data.address.postcode &&
                        data.address.suburb) {
                        //console.log('complete address found');
                        //console.log(data.address);
                        var postalcode = document.getElementById('postal_code');
                        var housenumber = document.getElementById('house_number');
                        var address = document.getElementById('address');
                        var city = document.getElementById('city');
                        var township = document.getElementById('township');
                        var nocode = document.getElementById('nocode'); // TODO: deze nog even standaard op false zetten als het allemaal gelukt is
                        if (postalcode, housenumber, address, city, township) {
                            postalcode.value = data.address.postcode;
                            housenumber.value = data.address.house_number;
                            address.value = data.address.road;
                            city.value = data.address.city;
                            township.value = data.address.suburb;
                             L.marker({lat: lat, lng: lon}).addTo($scope.map);
                            $scope.map.setView(new L.LatLng(lat, lon), 13);
                        }
                    } else {
                        console.log('wrong address found');
                        alert('Foutief adres gevonden: ' + data.display_name);
                        // TODO: Opmerking van Mark: We weten hier vrij exact een locatie maar kunnen daar (qua) adres niks mee, kunnen we daar niet alsnog wat mee? ;-)
                    }
                } else {
                    console.log('no address found');
                    // TODO: DIT IS NIET GETEST, GAAT OPENSTREETMAP NIET OP ZIJN GAT ALS ER GEEN ADRES IS? OF IETS RAARS MEEGESTUURD WORDT
                }

            }
        });
    }
    $('#sendLocationButton').click(sendLocationRequest);
    function sendLocationRequest(){
        $.ajax({
            type:'POST',
            url:'/api/mail',
            data: {id: locationId},
            success: function() {
                alert("mail verzonden");
                getLocationRecord();
            }
        });
    }
}])
=======
	//
	// $scope.init = function(){
	// 	$scope.refresh();
	// 	$http.get('getuser').success(function(data){
	// 		$scope.users = data;
	//
	// 	});
	// }




	// $scope.addUser = function(){
	// 	if(!$scope.name || !$scope.year || !$scope.month || !$scope.day || !$scope.address || !$scope.lat || !$scope.lng) {
	// 		$("#myModal").modal({
	// 			show: 'false'
	// 		});
	// 		return;
	// 	}
	// 	$http.post("insert?name="+$scope.name+"&birth="+$scope.year+"-"+$scope.month+"-"+$scope.day+"&address="+$scope.address+"&lat="+$scope.lat+"&lng="+$scope.lng).success(function(data){
	// 		$scope.users = data;
	// 		$scope.refresh();
	// 	});
	// }
	// $scope.removeUser = function(index){
	// 	$http.post('delete?id='+$scope.users[index].id).success(function(data){
	// 		$scope.users = data;
	// 		$scope.refresh();
	// 	});
	// }
	// $scope.refresh = function(){
	// 	$scope.markers.clearLayers();
	// 	for (var i in $scope.users) {
	// 		$scope.marker = new L.marker(new L.LatLng($scope.users[i].lat, $scope.users[i].lng))
	// 			.bindPopup($scope.users[i].name + ", " + $scope.users[i].birth + ", " + $scope.users[i].address);
	// 		$scope.markers.addLayer($scope.marker);
	// 	}
	// 	$scope.map.addLayer($scope.markers);
	// }
	// $scope.init();
}])
// .directive("tableDirective", function() {
// 	// body...
// 	return {
// 		template: '<div class="content"><div class="col-md-4"><form class="form-horizontal text-left panel panel-success">'+
// 		'<div class="form-group"><label for="name" class="col-sm-3">Name:</label><div class="col-sm-9"><input type="text" ng-model="name" id="name" class="form-control"></input></div></div>'+
// 		'<div class="form-group form-inline"><label for="birth" class="col-sm-3">Birthday:</label><div class="col-sm-9"><select ng-model="year" class="form-control"><option ng-repeat="x in years">{{x}}</option></select><label>Y</label><select ng-model="month" class="form-control"><option ng-repeat="x in months">{{x}}</option></select><label>M</label><select ng-model="day" class="form-control"><option ng-repeat="x in days">{{x}}</option></select><label>D</label></div></div>'+
// 		'<div class="form-group"><label for="address" class="col-sm-3">Address:</label><div class="col-sm-9"><input type="text" ng-model="address" class="form-control" id="address"></input></div></div>'+
// 		'<div class="form-group"><label for="lat" class="col-sm-3">Lat:</label><div class="col-sm-9"><input type="number" ng-model="lat" placeholder="-90 to 90" min="-90" max="90" class="form-control" id="lat"></div></div>'+
// 		'<div class="form-group"><label for="lng" class="col-sm-3">Lng:</label><div class="col-sm-9"><input type="number" ng-model="lng" placeholder="-180 to 180" min="-180" max="180" class="form-control" id="lng"></div></div>'+
// 		'<div class="form-group"><input type="submit" value="Add" ng-click="addUser()" class="form-control btn btn-primary"></input></div></form></div>'+
// 		'<div class="col-md-8 table-responsive"><table class="panel panel-success table table-bordered table-hover table-striped"><thead><tr><th class="name">Name</th><th class="birth">birth</th><th class="address">Address</th><th class="lat">Lat</th><th class="lng">Lng</th><th class="option text-center">Delete</th></tr></thead><tr ng-repeat="x in users track by $index"><td class="name">{{x.name}}</td><td class="birth">{{x.birth}}</td><td class="address">{{x.address}}</td><td class="lat">{{x.lat}}</td><td class="lng">{{x.lng}}</td><td class="option text-center"><a ng-click="removeUser($index)"><span class="glyphicon glyphicon-remove"></span></a></td></tr></table></div></div>'
// 	};
// });
>>>>>>> 15182f4c7447e578809c1552ae12c0d945574e40
