
function initMap() {

    map = new google.maps.Map(document.getElementById("address"));
    const input = document.getElementById("address");
    const autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener("place_changed", () => {

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

    document.getElementById("lng").value = place.geometry.location.lng();
    document.getElementById("lat").value = place.geometry.location.lat();


    })

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
    // console.log(position)
    lat = position.coords.latitude;
    lng = position.coords.longitude;
    let latLng = new google.maps.LatLng(lat, lng)
    document.getElementById("lng").value = latLng.lng();
    document.getElementById("lat").value = latLng.lat();
    setAddress(latLng)
}