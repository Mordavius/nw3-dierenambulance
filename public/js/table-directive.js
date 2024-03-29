var app = angular.module("app", [])
    .controller("TableController", ['$scope','$http', function($scope, $https){
        var markers = [];
        var marker;

        $scope.distance = [];
        $scope.map = L.map("map", {
            center: [53, 5.7],
            zoom: 10,
        });
        // $scope.map = L.map('map').setView([53, 5.7], 10);
        $scope.map2 = L.map("map2", {
            center: [53, 5.7],
            zoom: 10,
            gestureHandling: true,
            gestureHandlingText: {
                touch: "Gebruik twee vingers om door de map te scrollen",
                scroll: "Gebruik ctrl + scroll om in te zoomen",
                scrollMac: "Gebruik \u2318 + scroll om in te zoomen"
            }
        });

        $scope.map3 = L.map("map3", {
            center: [53, 5.7],
            zoom: 10,
            gestureHandling: true,
            gestureHandlingText: {
                touch: "Gebruik twee vingers om door de map te scrollen",
                scroll: "Gebruik ctrl + scroll om in te zoomen",
                scrollMac: "Gebruik \u2318 + scroll om in te zoomen"
            }
        });

        $scope.coordinates = [];
        var ticket_information = {"name": "", "number": "",
            "address": "", "house_number": "", "postal_code": "", "city": "", "township": "",
            "coordinates": "", "selected_animal": "", "breed": "", "gender":""
            , "injury": "", "description": "", "priority":""};


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

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> Contributors',
                maxZoom: 30,
                minZoom: 1,
            }).addTo($scope.map3);

        function onMapClick(e) {
            makeRequest("GET", reverseGeocodeQuery("json", e.latlng.lat, e.latlng.lng, 18), function(err, result) {
                if(err) { throw err; }
                marker = L.marker(e.latlng).addTo($scope.map);
                markers += marker;
                var obj = JSON.parse(result);
                updateAddressInformation(obj, e);
            })
            if(marker){
                $scope.map.removeLayer(marker);
            }
        }

        var coords = $('#map2').data('coordinates')

        coords.forEach(function(coord){

            if (coord != null) {
                placeMarker(coord);
            }
            function placeMarker(i){
                var latlng = L.latLng(i.lat, i.lng);
                var marker = L.marker(latlng).addTo($scope.map2);
                // $scope.distance.push(latlng);
            }
        })

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
            address_field.innerHTML = obj.address.road  ? obj.address.road + " " : "Straatnaam onbekend";
            house_number_field.innerHTML = obj.address.house_number ? obj.address.house_number + " ": " ";
            postal_code_field.innerHTML = obj.address.postcode ? obj.address.postcode + " " : "Kan postcode niet vinden";
            city_field.innerHTML = obj.address.suburb ? obj.address.suburb : "Kan stad niet vinden";
            township_field.innerHTML = obj.address.city ? obj.address.city : "Kan gemeente niet vinden";
            coordinates_field.value = JSON.stringify(e.latlng);
        }
        $scope.map.on('click', onMapClick);


        var locationId =  Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

        $('#searchButton').click(searchButtonClicked);

        $("#searchTextBox").on('keyup', function (e) {
            if (e.keyCode == 13) {
                searchButtonClicked();
            }
        });

        function searchButtonClicked(){
            var searchText = document.getElementById("searchTextBox").value.replace(/\s/g, '');

            makeRequest("GET", geocodeQuery(searchText), function(err, result) {
                if(err) { throw err; }
                var searchedURLJson = JSON.parse(result);

                makeRequest("GET", reverseGeocodeQuery("json", searchedURLJson[0].lat, searchedURLJson[0].lon, 18), function(err, result2) {
                    if(err) { throw err; }
                    var searchedURLJson2 = JSON.parse(result2);
                    setMarkerForLocation(searchedURLJson2);
                });
            });
        }

        function geocodeQuery(searchText) {
            var searchedURL = "https://nominatim.openstreetmap.org/search/nl/" + searchText + "?format=json&addressdetails=1";
            return searchedURL;
        }

        function setMarkerForLocation(searchedURLJson) {
            var searchedLat = searchedURLJson.lat;
            var searchedLon = searchedURLJson.lon;
            var marker = L.marker({lat: searchedLat, lng: searchedLon}).addTo($scope.map);

            address_field.innerHTML = searchedURLJson.address.road  ? searchedURLJson.address.road + " " : "Straatnaam onbekend";
            house_number_field.innerHTML = searchedURLJson.address.house_number ? searchedURLJson.address.house_number + " ": " ";
            postal_code_field.innerHTML = searchedURLJson.address.postcode ? searchedURLJson.address.postcode + " " : "Kan postcode niet vinden";
            city_field.innerHTML = searchedURLJson.address.suburb ? searchedURLJson.address.suburb : "Kan stad niet vinden";
            township_field.innerHTML = searchedURLJson.address.city ? searchedURLJson.address.city : "Kan gemeente niet vinden";
            // coordinates_field.value = JSON.stringify(e.latlng);


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
        $('#footer_button_forward').click(next);
        $('#footer_button_back').click(back);


        function next() {

            if(page1.className == "pages current_page")
            {
                jQuery("p.alert").remove();
                if (name_text_field.value == ""){
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Naam melder is niet ingevuld!</p>');
                    return false;
                }if(number_text_field.value == ""){
                jQuery('.alert-danger.name').hide();
                jQuery('.alert-danger.name').show();
                jQuery('.alert-danger.name').append('<p class="alert">Telefoonnummer melder is niet ingevuld!</p>');
            }
                if(!jQuery.isNumeric(number_text_field.value)) {
                    jQuery('.alert-danger.name').hide();
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Telefoonnummer mag alleen nummers bevatten!</p>');
                    return false;
                }
                if (number_text_field.value.length < 9){
                    jQuery('.alert-danger.name').hide();
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Telefoonnummer is niet correct!</p>');
                    return false;
                }
                else{
                    footer_button_back.style.visibility = "visible";
                    page1.style.marginLeft = "-100%";
                    page2.style.marginLeft = "0%";
                    page2.className = "pages current_page";
                    map.style.height = "100%";
                    map.style.width = "100%";
                    ticket_information.name = name_text_field.value;
                    ticket_information.number = number_text_field.value;
                    $scope.map.invalidateSize();
                    page1.className = "pages";
                    circle1.className = "circle previous";
                    span1.className = "span previous";
                    divider1.className = "divider previous";
                    circle2.className = "circle highlighted";
                }
            }else if(page2.className == "pages current_page")
            {
                page2.style.marginLeft = "-100%";
                page3.style.marginLeft = "0%";
                page3.className = "pages current_page";
                ticket_information.address = address_field.innerHTML;
                ticket_information.house_number = house_number_field.innerHTML;
                ticket_information.postal_code = postal_code_field.innerHTML;
                ticket_information.city = city_field.innerHTML;
                ticket_information.township = township_field.innerHTML;
                ticket_information.coordinates = coordinates_field.value;
                address_field.innerHTML = "";
                house_number_field.innerHTML = "";
                postal_code_field.innerHTML = "";
                city_field.innerHTML = "";
                township_field.innerHTML = "";
                page2.className = "pages";
                circle2.className = "circle previous";
                span2.className = "span previous";
                divider2.className = "divider previous";
                circle3.className = "circle highlighted";

            }else if(page3.className == "pages current_page")
            {
                jQuery("p.alert").remove();
                if (selected_animal.innerText == ""){
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Diersoort niet ingevuld</p>');
                    return false;
                }
                else {
                    page3.style.marginLeft = "-100%";
                    page4.style.marginLeft = "0%";
                    page4.style.marginBottom = "55px";
                    page4.className = "pages current_page";
                    map2.style.height = "600px";
                    map2.style.width = "100%";
                    ticket_information.selected_animal = selected_animal.innerHTML;
                    ticket_information.breed = breed_field.value;
                    ticket_information.injury = injury_field.value;
                    ticket_information.gender = gender_field.value;
                    ticket_information.description = description_field.value;
                    $scope.map2.invalidateSize();
                    loadTicketInformation();
                    page3.className = "pages";
                    circle3.className = "circle previous";
                    span3.className = "span previous";
                    divider3.className = "divider previous";
                    circle4.className = "circle highlighted";
                }
            }else if(page4.className == "pages current_page") {
                jQuery("p.alert").remove();
                if (priority_field.value == "") {
                    priority_field.value = "99";
                    footer_button_forward.style.visibility = "hidden";
                    ticket_information.priority = priority_field.value;
                    page4.style.marginLeft = "-100%";
                    page5.style.marginLeft = "0%";
                    page5.className = "pages current_page";
                    page4.className = "pages";
                    circle4.className = "circle previous";
                    span4.className = "span previous";
                    divider4.className = "divider previous";
                    circle5.className = "circle highlighted";
                    loadTicketInformation();
                } else {
                    footer_button_forward.style.visibility = "hidden";
                    ticket_information.priority = priority_field.value;
                    page4.style.marginLeft = "-100%";
                    page5.style.marginLeft = "0%";
                    page5.className = "pages current_page";
                    page4.className = "pages";
                    circle4.className = "circle previous";
                    span4.className = "span previous";
                    divider4.className = "divider previous";
                    circle5.className = "circle highlighted";
                    loadTicketInformation();
                    console.log(ticket_information);
                }
            }
        }

        function back() {
            if(page2.className == "pages current_page")
            {
                footer_button_back.style.visibility = "hidden";
                page2.style.marginLeft = "-100%";
                page1.style.marginLeft = "0%";
                page1.className = "pages current_page";
                page2.className = "pages";
                circle2.className = "circle";
                divider1.className = "divider";
                span1.className = "span";
                circle1.className = "circle highlighted";
            }else if(page3.className == "pages current_page"){
                page3.style.marginLeft = "-100%";
                page2.style.marginLeft = "0%";
                page2.className = "pages current_page";
                page3.className = "pages";
                circle3.className = "circle";
                span2.className = "span";
                divider2.className = "divider";
                circle2.className = "circle highlighted";
            }else if(page4.className == "pages current_page"){
                page4.style.marginLeft = "-100%";
                page3.style.marginLeft = "0%";
                page3.className = "pages current_page";
                page4.className = "pages";
                circle4.className = "circle";
                span3.className = "span";
                divider3.className = "divider";
                circle3.className = "circle highlighted";
            }else if(page5.className == "pages current_page"){
                footer_button_forward.style.visibility = "visible";
                page5.style.marginLeft = "-100%";
                page4.style.marginLeft = "0%";
                page4.className = "pages current_page";
                page5.className = "pages";
                circle5.className = "circle";
                span4.className = "span";
                divider4.className = "divider";
                circle4.className = "circle highlighted";
            }
        }
        function loadTicketInformation(){
            animal_title.innerHTML += ticket_information.selected_animal;
            animal_breed.innerHTML += ticket_information.breed;
            destination_info.innerHTML += ticket_information.address;
            if(!ticket_information.housenumber){
                destination_info.innerHTML += ticket_information.house_number;
            }
            destination_info.innerHTML += ticket_information.postal_code;
            destination_info.innerHTML += ticket_information.city;
            coordinates.value = ticket_information.coordinates;
            reporter_name.value = ticket_information.name;
            phone_number.value = ticket_information.number;

            address.value = ticket_information.address;
            house_number.value = ticket_information.house_number;
            postal_code.value = ticket_information.postal_code;
            city.value = ticket_information.city;
            township.value = ticket_information.township;

            animal_species.value = ticket_information.selected_animal;
            breed.value = ticket_information.breed;
            gender.value = ticket_information.gender;
            injury.value = ticket_information.injury;
            description.value = ticket_information.description;
            priority.value = ticket_information.priority;
        }

        $('#footer_button_submit').click(submit);
        function submit() {
            if (page5.className == "pages current_page") {
                jQuery("p.alert").remove();
                if (postal_code.value == "") {
                    jQuery('.alert-danger.name').hide();
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Postcode niet ingevuld</p>');
                    return false;
                }
                if (name_text_field.value == ""){
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Naam melder is niet ingevuld!</p>');
                    return false;
                }if(number_text_field.value == ""){
                    jQuery('.alert-danger.name').hide();
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Telefoonnummer melder is niet ingevuld!</p>');
                    return false;
                }
                if(!jQuery.isNumeric(number_text_field.value)) {
                    jQuery('.alert-danger.name').hide();
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Telefoonnummer mag alleen nummers bevatten!</p>');
                    return false;
                }
                if (number_text_field.value.length  < 9){
                    jQuery('.alert-danger.name').hide();
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Telefoonnummer is niet correct!</p>');
                    return false;
                }
                if (animal_species.value == ""){
                    jQuery('.alert-danger.name').show();
                    jQuery('.alert-danger.name').append('<p class="alert">Diersoort niet ingevuld</p>');
                    return false;
                }
                else {
                    var postcode = postal_code.value.replace(/\s/g, '');
                    makeRequest("GET", geocodeQuery(postcode), function (err, result) {
                        if (err) {
                            throw err;
                        }
                        var obj = JSON.parse(result);
                        if (obj[0] == undefined) {
                            if (page5.className == "pages current_page") {
                                jQuery("p.alert").remove();
                                jQuery('.alert-danger.name').show();
                                jQuery('.alert-danger.name').append('<p class="alert">Ingevulde postcode is ongeldig</p>');
                            }
                        }
                        else {
                            var latLngSubmit = {"lat": obj[0].lat, "lng": obj[0].lon};
                            coordinates.value = JSON.stringify(latLngSubmit);
                            console.log(obj);
                            makeRequest("GET", reverseGeocodeQuery("json", obj[0].lat, obj[0].lon, 18), function(err, result2) {
                                if(err) { throw err; }
                                var searchedURLJson2 = JSON.parse(result2);
                                setMarkerForLocation(searchedURLJson2);
                                ticket_information.address = address_field.innerHTML;
                                ticket_information.house_number = house_number_field.innerHTML;
                                ticket_information.postal_code = postal_code_field.innerHTML;
                                ticket_information.city = city_field.innerHTML;
                                ticket_information.township = township_field.innerHTML;
                                ticket_information.coordinates = coordinates_field.value;
                                if (house_number.value == "" && city.value == "") {
                                    address.value = ticket_information.address;
                                    house_number.value = ticket_information.house_number;
                                    postal_code.value = ticket_information.postal_code;
                                    city.value = ticket_information.city;
                                    township.value = ticket_information.township;
                                }
                            });
                        }
                        if (address.value != "" && postal_code.value != "" && city.value != "") {
                            document.forms["submit_form"].submit();
                        }else {
                            alert('stad, straat, postcode moeten ingevuld zijn')
                        }
                    });
                }
            }
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
                    console.log(data);
                    if(data.address && data.display_name) {
                        if (data.address.house_number &&
                            data.address.road &&
                            data.address.city &&
                            data.address.postcode &&
                            data.address.suburb) {
                            //console.log('complete address found');
                            //console.log(data.address);
                            var postalcode = document.getElementById('postal_code_field');
                            var housenumber = document.getElementById('house_number_field');
                            var address = document.getElementById('address_field');
                            var city = document.getElementById('city_field');
                            var township = document.getElementById('township_field');
                            var nocode = document.getElementById('nocode'); // TODO: deze nog even standaard op false zetten als het allemaal gelukt is
                            if (postalcode, housenumber, address, city, township) {
                                postalcode.innerText = data.address.postcode;
                                housenumber.innerText = data.address.house_number;
                                address.innerText = data.address.road;
                                city.innerText = data.address.city;
                                township.innerText = data.address.suburb;
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
        // function sendLocationRequest(){
        //     $.ajax({
        //         type:'POST',
        //         url:'/api/mail',
        //         data: {id: locationId},
        //         success: function() {
        //             alert("mail verzonden");
        //             getLocationRecord();
        //         }
        //     });
        // }

        function sendLocationRequest() {
            $.ajax({
                type: 'POST',
                url: '/api/sms',
                data: {id: locationId,
                    phonenumber: $('#number_text_field').val()
                },
                success: function (data) {
                    alert("SMS verzonden");
                    console.log(locationId);
                    getLocationRecord();
                },
                error: function () {
                    alert("Er is iets fout gegaan, als u dit bericht vaker ziet neem dan contact op met de beheerder");
                }
            });
        }
    }]);

function selectAnimalSpieces(animal_species, image_animal){
    var growDiv = document.getElementById('animal_cards');
    if (growDiv.clientHeight) {
        growDiv.style.height = 0;
        setTimeout(function()
        {
            if (!selectedAnimal.clientHeight) {
                growDiv.style.display = "none";
                selectedAnimal.style.height = "45px";
                selectedAnimal.style.padding = "8px 16px";
                image.src =  "/" + image_animal;
                console.log(image.src);

                selected_animal.innerHTML = animal_species;
            }
        },300);
    }
}
