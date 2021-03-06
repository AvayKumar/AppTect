var API_KEY = 'AIzaSyAkcIJSLJXcO0VwoNDjp6Zhavg7m1svaSk';
var geocoder;
var map;
var marker;
var isSource = true;  
var isSourceSet = false;
var isDestSet = false;
var source, dest;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

/*
 Direction functions
*/
function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);
}

function calcRoute(start , end) {
  if( isSourceSet && isDestSet ) {
    var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(result, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(result);
        sourceMarker.setMap(null);
        destMarker.setMap(null);
      } else {
        sourceMarker.setMap(map);
        destMarker.setMap(map);
      }
    });

    distance();
    latlang();

  }
} 

/*
  For latitude Longitude Filling
*/

function latlang(){

    $('#sourcelat').val(source.lat());
    $('#sourcelng').val(source.lng());

    $('#destlat').val(dest.lat());
    $('#destlng').val(dest.lng());

}

/*
  For Distance Calculation
*/
function distance(){

    var sLatLan = source.lat() + ',' + source.lng();
    var dLatLan = dest.lat() + ',' + dest.lng();
    var ptype   = $('#dropdown :selected').attr('data-ptype');
    var prate   = $('#dropdown :selected').attr('data-prate');
    var mult;
    var amount;
    


    var requestUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=' + sLatLan + '&destinations=' + dLatLan + '&key=' + API_KEY ;
    console.log( requestUrl );

    $.get(requestUrl, function(response) {

        console.log(response);  

        if( response.status == 'OK' ) {

          $('#estdistance').val( response.rows[0].elements[0].distance.text );
          $('#esttime').val( response.rows[0].elements[0].duration.text );

                if (ptype== 'km'){

                mult = (response.rows[0].elements[0].distance.value)/1000;

                }else {

                mult =  (response.rows[0].elements[0].duration.value)/3600; 
                }
                amount = prate*mult;
                amount = amount.toFixed(2);
                $('#amount').val( amount );


        }

    }, 'JSON');
 }


/*
  END : direction functions
*/

// initialise the google maps objects, and add listeners
function gmaps_init(){

  // center of the universe
  var sourceLatLang = new google.maps.LatLng(21.0000,78.0000);
  var destLatLang = new google.maps.LatLng(21.0000,78.0000);


    var options = {
    zoom: 4,
    center: sourceLatLang,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  

  // create our map object
  map = new google.maps.Map(document.getElementById("gmaps-canvas"), options);

  // the geocoder object allows us to do sourceLatLang lookup based on address
  geocoder = new google.maps.Geocoder();

  // the marker shows us the position of the latest address
  sourceMarker = new google.maps.Marker({
    map: map,
    draggable: false,
    icon: 'img/blue-dot.png'  
  });

  destMarker = new google.maps.Marker({
    map: map,
    draggable: false,
    icon: 'img/green-dot.png'
  });

  // event triggered when marker is dragged and dropped
  /*google.maps.event.addListener(marker, 'dragend', function() {
    geocode_lookup( 'sourceLatLang', marker.getPosition() );
  });*/
  
  // event triggered when map is clicked
  google.maps.event.addListener(map, 'click', function(event) {
    if( isSource ) {
      sourceMarker.setPosition(event.latLng);
      source = event.latLng;
      isSourceSet = true;
    } else {
      destMarker.setPosition(event.latLng);
      dest = event.latLng;
      isDestSet = true;
    }
    geocode_lookup( 'latLng', event.latLng  );
    calcRoute(source, dest);
  });

  $('#gmaps-error').hide();
}

// move the marker to a new position, and center the map on it
function update_map( geometry ) {
  if( isSource ) {
    map.fitBounds( geometry.viewport );
    source = geometry.location;
    isSourceSet = true;
    sourceMarker.setPosition( geometry.location );
  } else {
    map.fitBounds( geometry.viewport );
    dest = geometry.location;
    isDestSet = true;
    destMarker.setPosition( geometry.location );
  }
  calcRoute(source, dest);


}

// fill in the UI elements with new position data
function update_ui( id, address, sourceLatLang ) {
  $( id ).autocomplete("close");
  $( id ).val(address);

  //$('#gmaps-output-latitude').html(sourceLatLang.lat());
  //$('#gmaps-output-longitude').html(sourceLatLang.lng());

}

// Query the Google geocode object
//
// type: 'address' for search by address
//       'sourceLatLang'  for search by sourceLatLang (reverse lookup)
//
// value: search query
//
// update: should we update the map (center map and position marker)?
function geocode_lookup( type, value, update ) {
  // default value: update = false
  update = typeof update !== 'undefined' ? update : false;

  request = {};
  request[type] = value;

  geocoder.geocode(request, function(results, status) {
    $('#gmaps-error').html('');
    $('#gmaps-error').hide();
    if (status == google.maps.GeocoderStatus.OK) {
      // Google geocoding has succeeded!
      if (results[0]) {
        // Always update the UI elements with new location data
        if( isSource ) {
          update_ui('#sourceLoc', results[0].formatted_address, results[0].geometry.location );
        } else {
          update_ui('#destLoc', results[0].formatted_address, results[0].geometry.location );
        }

        // Only update the map (position marker and center map) if requested
        if( update ) { 
          update_map( results[0].geometry ) 
        }
      } else {
        // Geocoder status ok but no results!?
        $('#gmaps-error').html("Sorry, something went wrong. Try again!");
        $('#gmaps-error').show();
      }
    } else {
      // Google Geocoding has failed. Two common reasons:
      //   * Address not recognised (e.g. search for 'zxxzcxczxcx')
      //   * Location doesn't map to address (e.g. click in middle of Atlantic)

      if( type == 'address' ) {
        // User has typed in an address which we can't geocode to a location
        $('#gmaps-error').html("Sorry! We couldn't find " + value + ". Try a different search term, or click the map." );
        $('#gmaps-error').show();
      } else {
        // User has clicked or dragged marker to somewhere that Google can't do a reverse lookup for
        // In this case we display a warning, clear the address box, but fill in sourceLatLang
        $('#gmaps-error').html("Woah... that's pretty remote! You're going to have to manually enter a place name." );
        $('#gmaps-error').show();
        
        if( isSource ) {
          update_ui('#sourceLoc' ,'', value);
        } else {
          update_ui('#destLoc' ,'', value);
        }


      }
    };
  });
};


// initialise the jqueryUI autocomplete element
function autocomplete_init( id ) {
  $(id).autocomplete({

    // source is the list of input options shown in the autocomplete dropdown.
    // see documentation: http://jqueryui.com/demos/autocomplete/
    source: function(request,response) {

      // the geocode method takes an address or sourceLatLang to search for
      // and a callback function which should process the results into
      // a format accepted by jqueryUI autocomplete
      geocoder.geocode( {'address': request.term }, function(results, status) {
        response($.map(results, function(item) {
          return {
            label: item.formatted_address, // appears in dropdown box
            value: item.formatted_address, // inserted into input element when selected
            geocode: item                  // all geocode data: used in select callback event
          }
        }));
      })
    },

    // event triggered when drop-down option selected
    select: function(event,ui) {
      update_ui(id, ui.item.value, ui.item.geocode.geometry.location )
      update_map(ui.item.geocode.geometry )
    }
  });

} // autocomplete_init

$(document).ready(function() { 
  if( $('#gmaps-canvas').length  ) {
    gmaps_init();
    initialize();
    autocomplete_init( '#sourceLoc' );
    autocomplete_init( '#destLoc' );
  }; 

  $('#sourceInd').addClass('loc-active');

  $('#sourceLoc').focusin(function(){
    isSource = true;
    $('#sourceInd').addClass('loc-active');
    $('#destInd').removeClass('loc-active');
  });

  $('#destLoc').focusin(function(){
    isSource = false;
    $('#sourceInd').removeClass('loc-active');
    $('#destInd').addClass('loc-active');
  });


  });


     
