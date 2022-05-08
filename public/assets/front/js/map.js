var map;
var marker;
var myLatLng = {}
var oldLng = document.getElementById("longval").value
var oldLat = document.getElementById("latval").value
if (oldLng != '' && oldLat != '' ) {
    myLatLng = { lat: parseFloat(oldLat),  lng: parseFloat(oldLng)};
}else{
    myLatLng = { lat: 41.57447847681161, lng: -87.30990515225302 };
}

function initMap() {
    map = new google.maps.Map(document.getElementById("googleMap"), {
        zoom: 4,
        center: myLatLng,
    });
    marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        draggable: true
    });
    marker.setMap(map);

    // Create the search box and link it to the UI element.
    const input = document.getElementById("address");
    const searchBox = new google.maps.places.SearchBox(input);

    const autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo("bounds", map);

    autocomplete.addListener("place_changed", () => {
        marker.setVisible(false);

        const place = autocomplete.getPlace();

        if (!place.geometry || !place.geometry.location) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        document.getElementById("longval").value = place.geometry.location.lng();
        document.getElementById("latval").value = place.geometry.location.lat();
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    });

    google.maps.event.addListener(map, 'click', function (event) {
        document.getElementById("longval").value = event.latLng.lng();
        document.getElementById("latval").value = event.latLng.lat();
        changeMarkerPosition(map, marker, event.latLng)
    });

    marker.addListener('dragend', function (event) {
        document.getElementById("longval").value = event.latLng.lng();
        document.getElementById("latval").value = event.latLng.lat();
        changeMarkerPosition(map, marker, event.latLng)
    });
}

function changeMarkerPosition(map, marker, latLng) {
    marker.setPosition(latLng);
    setAddress(latLng)
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function setAddress(latLng) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'latLng': latLng
    }, (results, status) => {
        if (status !== google.maps.GeocoderStatus.OK) {
            alert(status);
        }
        if (status == google.maps.GeocoderStatus.OK) {
            var address = (results[0].formatted_address);
            document.getElementById("address").value = address;
        }
    });
}

function showPosition(position) {
    myLatLng.lat = position.coords.latitude;
    myLatLng.lng = position.coords.longitude;
    let latLng = new google.maps.LatLng(myLatLng.lat, myLatLng.lng)
    map.panTo(latLng);
    marker.setPosition(latLng);
    document.getElementById("longval").value = myLatLng.lng;
    document.getElementById("latval").value = myLatLng.lat;
    setAddress(myLatLng)
}
