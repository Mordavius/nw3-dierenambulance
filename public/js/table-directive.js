var app = angular.module("app", [])
.controller("TableController", ['$scope','$http', function($scope, $https){

    $scope.distance = [];
    $scope.map = L.map('map').setView([53, 5.7], 10);
    $scope.map2 = L.map('map2').setView([53, 5.7], 10);
	$scope.coordinates = [];
    var ticket_information = {"name_text_field": "", "number_text_field": "",
    "address": "", "house_number": "", "postal_code": "", "city": "",
    "coordinates": "", "selected_animal": "", "breed": "", "gender":""
    , "chip_number": "", "injury": "", "description": ""};

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> Contributors',
        maxZoom: 30,
        minZoom: 1,
    }).addTo($scope.map);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> Contributors',
        maxZoom: 30,
        minZoom: 1,
    }).addTo($scope.map2);

	function onMapClick(e) {
		makeRequest("GET", reverseGeocodeQuery("json", e.latlng.lat, e.latlng.lng, 18), function(err, result) {
			if(err) { throw err; }
			var marker = L.marker(e.latlng).addTo($scope.map);
			var obj = JSON.parse(result);
			updateAddressInformation(obj, e);
        })
	}

    var coords = $('#map2').data('coordinates')
	coords.forEach(function(coord){
		placeMarker(coord);
	})

	function placeMarker(i){
		var latlng = L.latLng(i.lat, i.lng);
		var marker = L.marker(latlng).addTo($scope.map2);
        // $scope.distance.push(latlng);
	}

	function reverseGeocodeQuery(format, lat, lon, zoom) {
			var url = "https://nominatim.openstreetmap.org/reverse?format=" + format + "&lat=" + lat + "&lon=" + lon + "&zoom=" + zoom + "&addressdetails=1";
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

	function updateAddressInformation(obj, e){
		document.getElementById("postal_code").value = obj.address.postcode ? obj.address.postcode : "Kan postcode niet vinden";
		document.getElementById("house_number").value = obj.address.house_number ? obj.address.house_number : "";
		document.getElementById("address").value = obj.address.road ? obj.address.road : "Straatnaam onbekend"
		document.getElementById("city").value = obj.address.suburb ? obj.address.suburb : "Kan stad niet vinden";
		document.getElementById("township").value = obj.address.city ? obj.address.city : "Kan gemeente niet vinden";
        document.getElementById('coordinates').value = JSON.stringify(e.latlng);
	}
	$scope.map.on('click', onMapClick);


    var locationId =  Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

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
    $('#footer_button').click(next);
    function next() {
        if(page1.className == "pages current_page")
        {
            page1.style.marginLeft = "-100%";
            page2.style.marginLeft = "0%";
            page2.className = "pages current_page";
            map.style.height = "400px";
            map.style.width = "100%";
            ticket_information.name_text_field = name_text_field.value;
            ticket_information.number_text_field = number_text_field.value;
            $scope.map.invalidateSize();

            setTimeout(function()
            {
                page1.className = "pages";
                circle1.className = "circle circle1";
                circle2.className = "circle circle2 highlighted";
            },
                1000);

        }else if(page2.className == "pages current_page")
         {
            page2.style.marginLeft = "-100%";
            page3.style.marginLeft = "0%";
            page3.className = "pages current_page";
            ticket_information.address = address.value;
            ticket_information.house_number = house_number.value;
            ticket_information.postal_code = postal_code.value;
            ticket_information.city = city.value;
            ticket_information.coordinates = coordinates.value;
            setTimeout(function()
            {
                page2.className = "pages";
                circle2.className = "circle circle2";
                circle3.className = "circle circle3 highlighted";
            },
                1000);
        }else if(page3.className == "pages current_page"){
            page3.style.marginLeft = "-100%";
            page4.style.marginLeft = "0%";
            page4.className = "pages current_page";
            map2.style.height = "400px";
            map2.style.width = "100%";
            $scope.map2.setView([53.03, 5.7], 10);
            ticket_information.selected_animal = selected_animal.innerHTML;
            ticket_information.breed = breed.value;
            ticket_information.injury = injury.value;
            ticket_information.gender = gender.value;
            ticket_information.chip_number = chip_number.value;
            ticket_information.chip_number = chip_number.value;
            ticket_information.description = description.value;
            $scope.map2.invalidateSize();
            loadTicketInformation();
            setTimeout(function()
            {
                page3.className = "pages";
                circle3.className = "circle circle3";
                circle4.className = "circle circle4 highlighted";

           },
               1000);
       }else if(page4.className == "pages current_page"){
          page4.style.marginLeft = "-100%";
          page5.style.marginLeft = "0%";
          page5.className = "pages current_page";
          setTimeout(function()
          {
              page4.className = "pages";
              circle4.className = "circle circle4";
              circle5.className = "circle circle5 highlighted";
          },
              1000);
      }
    }
    function loadTicketInformation(){
        animal_title.innerHTML += ticket_information.selected_animal;
        animal_breed.innerHTML += ticket_information.breed;
        destination_info.innerHTML += ticket_information.address + " ";
        if(!ticket_information.housenumber){
            destination_info.innerHTML += ticket_information.house_number + ", ";
        }
        destination_info.innerHTML += ticket_information.postal_code + " ";
        destination_info.innerHTML += ticket_information.city;
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

function selectAnimalSpieces(animal_species){
    var growDiv = document.getElementById('animal_cards');
    if (growDiv.clientHeight) {
      growDiv.style.height = 0;
      setTimeout(function()
      {
          if (!selectedAnimal.clientHeight) {
              selectedAnimal.style.height = 45;
              selected_animal.innerHTML = animal_species;
          }
      },300);
    }
}
