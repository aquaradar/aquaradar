var s = document.createElement("script");
s.type = "text/javascript";
s.onload = function () {
    autocomplete();
};
s.src = '//maps.googleapis.com/maps/api/js?key=' + gmapKey + '&libraries=places';

document.body.appendChild(s);

function autocomplete() {

    var options = {
        componentRestrictions: {country: 'br'},
        strictBounds: true
    };

    var element = document.getElementById('notification_address');

    var autocomplete = new google.maps.places.Autocomplete(element, options);

    var geolocation = {
        lat: -22.3176761,
        lng: -49.0691349
    };
    var circle = new google.maps.Circle({
        center: geolocation,
        radius: 8000
    });
    autocomplete.setBounds(circle.getBounds());

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        place = autocomplete.getPlace();

        if (null == place.geometry) {
            element.value = '';
            return false;
        }

        document.getElementById('notification_latitude').value = place.geometry.location.lat();
        document.getElementById('notification_longitude').value = place.geometry.location.lng();
    });
}

document.getElementById('notification_address').addEventListener('keyup', function () {
    document.getElementById('notification_latitude').value = document.getElementById('notification_longitude').value = '';
});