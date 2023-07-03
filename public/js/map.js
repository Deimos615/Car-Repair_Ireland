google.maps.event.addDomListener(window, 'load', initialize);

let directionsRenderer;
// let directionsService;
const directionsService = new google.maps.DirectionsService();

function initialize() {
  var options = {
    // types: ['(cities)'],
    types: ['address'],
    componentRestrictions: { country: "ie" }
  };
  var pickup_location = document.getElementById('pickup_location');
  var destination_location = document.getElementById('destination_location');

  var autocomplete_pick = new google.maps.places.Autocomplete(pickup_location, options);
  var autocomplete_desti = new google.maps.places.Autocomplete(destination_location, options);

  // directionsRenderer = new google.maps.DirectionsRenderer({
  //   suppressMarkers: true,
  //   map: map,
  // });

  autocomplete_pick.addListener('place_changed', function () {
    var first_place = autocomplete_pick.getPlace();
    directionsRenderer.setDirections(null);
    directionsRenderer.setMap(null); // clear previous route
    directionsService.route(
      {
        origin: first_place.formatted_address,
        destination: destination_location.value,
        travelMode: "DRIVING",
      },
      (response, status) => {
        if (status === "OK") {
          directionsRenderer.setMap(map); // set new route
          directionsRenderer.setDirections(response);
        }
      }
    );
  });
  autocomplete_desti.addListener('place_changed', function () {
    var second_place = autocomplete_desti.getPlace();
    directionsRenderer.setDirections(null); // clear previous route
    directionsRenderer.setMap(null); // clear previous route
    directionsService.route(
      {
        origin: pickup_location.value,
        destination: second_place.formatted_address,
        travelMode: "DRIVING",
      },
      (response, status) => {
        if (status === "OK") {
          directionsRenderer.setMap(map); // set new route
          directionsRenderer.setDirections(response);
        }
      }
    );
  });

}

function esti_calc() {
  var pickup_location = document.getElementById("pickup_location").value;
  var destination_location = document.getElementById("destination_location").value;
  var cost_val = document.getElementById("cost_val").innerHTML;

  if (pickup_location == '') {
    Command: toastr["warning"]("Please input a pickup location", "Warning");
    return false;
  }
  if (destination_location == '') {
    Command: toastr["warning"]("Please input a destination location", "Warning");
    return false;
  }

  if (directionsRenderer) {
    directionsRenderer.setDirections(null); // clear previous route
    directionsRenderer.setMap(null);
  }

  directionsService.route(
    {
      origin: pickup_location,
      destination: destination_location,
      travelMode: "DRIVING",
    },
    (response, status) => {
      if (status === "OK") {

        directionsRenderer = new google.maps.DirectionsRenderer({
          suppressMarkers: true,
          directions: response,
          map: map,
        });

        // Save the reference to the directions renderer
        // so we can remove it later
        directionsRenderer.setMap(map);
      }
    }
  )

  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: [pickup_location],
      destinations: [destination_location],
      travelMode: 'DRIVING',
    }, callback);

  function callback(response, status) {
    if (status == 'OK') {
      var origins = response.originAddresses;
      var destinations = response.destinationAddresses;

      for (var i = 0; i < origins.length; i++) {
        var results = response.rows[i].elements;
        for (var j = 0; j < results.length; j++) {
          var element = results[j];
          var distance = element.distance.text;
          var distance_value = element.distance.value;
          var duration = element.duration.text;
          var from = origins[i];
          var to = destinations[j];
        }
      }
    }
    var result_cost = distance_value * cost_val / 1000;
    var result_cost = Math.round(result_cost);

    var mincost_value = $('#mincost_val').html();
    if (result_cost < mincost_value) {
      final_cost = mincost_value;
    } else {
      final_cost = result_cost;
    }

    document.getElementById("distance_val").innerHTML = distance;
    document.getElementById("duration_val").innerHTML = duration;
    document.getElementById("estimation_val").innerHTML = final_cost;
  }
}

const map = new google.maps.Map(document.getElementById("map"), {
  center: new google.maps.LatLng(53.14, -6.85),
  zoom: 7,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
});