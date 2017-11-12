var latlng = new google.maps.LatLng(43.6111, 3.87667);
var options = { zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map(document.getElementById('map_canvas'), options);
