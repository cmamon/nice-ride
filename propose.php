<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.html'; ?>
        <title>Proposer un voyage</title>
    </head>
    <body>
        <header>
            <?php require 'header.php'; ?>
        </header>

        <?php
            // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                // if (pas de voiture enregistrée) {
                //     echo "Vous n'avez pas encore enregistré de voiture";
                //     echo "<form style=\"display: inline\" action=\"registerCar.php\" method=\"get\">";
                //     echo "<button>Enregistrer un véhicule</button>";
                //     echo "</form>";
                // } else {

                //     echo "Bienvenue , " . $_SESSION['username'] . "!";
            // }
            // } else {
            //     echo "Enregistrez vous pour voir cette page.";
            // }
        ?>
        <div class="main">
            <div class="twoParts">
                <div class="part1">
                    <div class="searchGroup">
                        <h3>Votre trajet :</h3>
                        <br>
                        <form method="post">
                            <label for="departureCity">De</label>
                            <input type="text" id="departureCity" class="cities" name="searchDepartureCity" placeholder="Ville de départ">
                            <br>
                            <label for="arrivalCity">Adresse de RDV</label>
                            <input type="text" id="meetingAdress" class="cities" name="meetingAdress" placeholder="n°rue Intitulé">
                            <br>
                            <label for="arrivalCity">À</label>
                            <input type="text" id="arrivalCity" class="cities" name="searchArrivalCity" placeholder="Ville d'arrivée">
                            <br>
                            <label for="arrivalCity">Adresse de dépose</label>
                            <input type="text" id="dropAdress" class="cities" name="dropAdress" placeholder="n°rue Intitulé">
                            <br>
                            <label for="date">Le</label>
                            <input type="date" id="date" name="tripDate" placeholder="Date">
                            <br>
                        </form>
                    </div>
                    <div id="output">

                    </div>
                    <h3>Renseignez le prix</h3>
                    <p>Prix suggéré : floor((donner le prix d'un tel trajet avec google ) - 3% du prix)</p>
                    <form class="" action="propose2.html" method="post">
                        <input type="number" min="0" max ="80" name="" value="">
                    </form>
                </div>
                <div class="part2">
                    <div id="map"></div>
                </div>
            </div>
        </div>

        <footer>
            <?php require 'footer.html'; ?>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">

        function initMap(){
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 46.227638, lng: 2.213749},
                zoom: 5
            });

            new AutocompleteDirectionsHandler(map);

          var bounds = new google.maps.LatLngBounds;
          var markersArray = [];

          var originInput = document.getElementById('departureCity').value;

          var destinationInput = document.getElementById('arrivalCity').value;

          var geocoder = new google.maps.Geocoder;

          var service = new google.maps.DistanceMatrixService;
          service.getDistanceMatrix({
            origins: [originInput],
            destinations: [destinationInput],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
          }, function(response, status) {
            if (status !== 'OK') {
              alert('Error was: ' + status);
            } else {
              var originList = response.originAddresses;
              console.log(originList);
              var destinationList = response.destinationAddresses;
              var outputDiv = document.getElementById('output');
              outputDiv.innerHTML = '';
            //   deleteMarkers(markersArray);

              var showGeocodedAddressOnMap = function(asDestination) {
                return function(results, status) {
                  if (status === 'OK') {
                    map.fitBounds(bounds.extend(results[0].geometry.location));
                    markersArray.push(new google.maps.Marker({
                      map: map,
                      position: results[0].geometry.location,
                    }));
                  } else {
                    alert('Geocode was not successful due to: ' + status);
                  }
                };
              };

              for (var i = 0; i < originList.length; i++) {
                var results = response.rows[i].elements;
                geocoder.geocode({'address': originList[i]},
                    showGeocodedAddressOnMap(false));
                for (var j = 0; j < results.length; j++) {
                  geocoder.geocode({'address': destinationList[j]},
                      showGeocodedAddressOnMap(true));
                    //   console.log(results[j]);
                  outputDiv.innerHTML += originList[i] + ' to ' + destinationList[j] +
                      ': ' + results[j].distance.text + ' in ' +
                      results[j].duration.text + '<br>';
                }
              }
            }
          });
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

        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: true});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: true});

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
      }

      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) {
            window.alert("Please select an option from the dropdown list.");
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
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      };

        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&libraries=places&callback=initMap">
        </script>
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVEJd3oceuJC5ivSIjaWvJomYNxc2JR_A&libraries=places&callback=searchPlaces"></script> -->
    </body>
</html>
