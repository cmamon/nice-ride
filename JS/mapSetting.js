var options = {
    types: ['(cities)'],
    componentRestrictions: {country: "fr"}
};
function activatePlacesSearch1(){
    var input = document.getElementById('departureCity');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}
function activatePlacesSearch2(){
    var input = document.getElementById('arrivalCity');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
}
function searchPlaces() {
    activatePlacesSearch1();
    activatePlacesSearch2();
}
