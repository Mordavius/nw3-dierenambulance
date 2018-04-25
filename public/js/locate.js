var locationId =  Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
var map = L.map('map').setView([53, 5.7], 10);
function getLocation() {
    if (navigator.geolocation) navigator.geolocation.getCurrentPosition(showPosition);
}

// var postalcode = document.getElementById('postalcode');
// var housenumber = document.getElementById('housenumber');
// var address = document.getElementById('address');
// var city = document.getElementById('city');
// var township = document.getElementById('township');

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
                        var marker = L.marker({lat: lat, lng: lon}).addTo(map);
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