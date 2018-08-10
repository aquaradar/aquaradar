var s = document.createElement("script");
s.type = "text/javascript";
s.onload = function () {
    autocomplete();
};
s.src = "//maps.googleapis.com/maps/api/js?key=AIzaSyCai41x2wQ6DF0HqF8R552eED4R7s1m1EU&libraries=places";

document.body.appendChild(s);

function autocomplete() {

    var element = document.getElementById('denouncement_address');

    var autocomplete = new google.maps.places.Autocomplete(element);

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        place = autocomplete.getPlace();

        if (null == place.geometry) {
            element.value = '';
            return false;
        }


        document.getElementById('denouncement_latitude').value = place.geometry.location.lat();
        document.getElementById('denouncement_longitude').value = place.geometry.location.lng();
    });
}

document.getElementById('denouncement_address').addEventListener('keyup', function(){
    document.getElementById('denouncement_latitude').value = document.getElementById('denouncement_longitude').value = '';
 }); 