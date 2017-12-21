function initMap(){
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 46.227638, lng: 2.213749},
        zoom: 5
    });

    new AutocompleteDirectionsHandler(map);
}

/**
* @constructor
*/
function AutocompleteDirectionsHandler(map) {
    this.map = map;
    this.originPlaceId = null;
    this.destinationPlaceId = null;
    this.travelMode = 'DRIVING';
    var originInput = document.getElementById('departureCity');
    var destinationInput = document.getElementById('arrivalCity');
    this.directionsService = new google.maps.DirectionsService;
    this.directionsDisplay = new google.maps.DirectionsRenderer;
    this.directionsDisplay.setMap(map);

    var optionsCities = {
        types: ['(cities)'],
        componentRestrictions: {country: "fr"},
        placeIdOnly: true
    };

    // var location = {}
    //
    // var optionsAdresses = {
    //     types: ['address'],
    //     componentRestrictions: {country: "fr"},
    //     placeIdOnly: true
    // }

    var originAutocomplete = new google.maps.places.Autocomplete(
        originInput, optionsCities);
        // console.log(originAutocomplete);
        // var meetingAddress = new google.maps.places.Autocomplete(
        //     meetingAdress, optionsAdresses);
        // console.log(originAutocomplete);

        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, optionsCities);
            // var dropAddress = new google.maps.places.Autocomplete(
            //     dropAddress, optionsAdresses);

            this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
            this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
        }

        AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
            var me = this;
            autocomplete.bindTo('bounds', this.map);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.place_id) {
                    window.alert("Entrez une ville");
                    return;
                }
                if (mode === 'ORIG') {
                    me.originPlaceId = place.place_id;
                } else {
                    me.destinationPlaceId = place.place_id;
                }
                me.route();
            });

        };

        AutocompleteDirectionsHandler.prototype.route = function() {
            if (!this.originPlaceId || !this.destinationPlaceId) {
                return;
            }
            var me = this;

            this.directionsService.route({
                origin: {'placeId': this.originPlaceId},
                destination: {'placeId': this.destinationPlaceId},
                travelMode: this.travelMode
            }, function(response, status) {
                if (status === 'OK') {
                    me.directionsDisplay.setDirections(response);

                    //Distance en mètres
                    var distance = response.routes[0].legs[0].distance.value;

                    var duration = response.routes[0].legs[0].duration.text;

                    var outputDiv = document.getElementById('info');
                    outputDiv.innerHTML += '<br><br><h4 style="display:inline-block">Distance moyenne :</h4> ' +  Math.ceil(distance / 1000) + ' km. <br><h4 style="display:inline-block">Durée estimée :</h4> '
                    + duration + '.<br><h4 style="display:inline-block">Prix suggéré :</h4> ' + Math.floor(0.10 * (distance / 1000)) + ' euros.</p>';
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        };
