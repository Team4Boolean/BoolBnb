/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.$ = require('jquery');


function initVue() {
  const app = new Vue({
      el: '#app',
  });
}
// FLAT-SHOW

function serviceInfo(){
  $('.service-item').hover(function() {
    $(this).children('.serv-info').css('display', 'inline-block');
  }, function() {
    $(this).children('.serv-info').css('display', 'none');
  });
}


// FLAT-CREATE

function addKeyUpListener()  {

  var button = $('.add_input');

  button.keyup(function(){
    getCoord();
  });
}

function getCoord() {

  // variabili per ajax
  var street = $('#street_name').val();
  var number = $('#street_number').val();
  var municipality = $('#municipality').val();
  var subdivision = $('#subdivision').val();
  var postal_code = $('#postal_code').val();

  $.ajax ({
   url : 'https://api.tomtom.com/search/2/structuredGeocode.json',
   method : 'GET',
   data : {
     countryCode : 'IT',
     limit : 1,
     streetNumber : number,
     streetName : street,
     municipality : municipality,
     countrySecondarySubdivision : subdivision,
     postalCode : postal_code,
     key : 'GAQpTuIuymbvAGETW9Qf0GSfF1ub9G0r'
   },
   success : function(data, state) {

     var arr = data['results'];

      for (var i = 0; i < arr.length; i++) {
        var address = arr[i];
        var position = address['position'];
        var lat = position['lat'];
        var lon = position['lon'];
        // LOG DI DEBUG
        console.log(lat);
        console.log(lon);
        // -----------
        $('#lon').val(lon);
        $('#lat').val(lat);
      }
   },
   error: function(request, state, error) {
     console.log('request' , request);
     console.log('state' , state);
     console.log('error' , error);
   }
 });
};

// input immagine + preview

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#prev').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

function showPreview(){
  $("#prevContainer").css("display", "block");
}

function uploadImg(){

  // sul change dell'input carichiamo l'immagine nell'html e la mettiamo in display block
  $("#imgInp").change(function() {
    readURL(this);
    showPreview()
  });

}

function autocompleteAddress() {
  var places = require('places.js');
  var placesAutocomplete = places({
    appId: 'plXJIJDQMD75',
    apiKey: '55b0a2a2464a36ae6c8b7c5436ea0ec8',
    container: document.querySelector('#street_name'),
    templates: {
      value: function(suggestion) {
        return suggestion.name;
      }
    }
  }).configure({
    type: 'address'
  });

  placesAutocomplete.on('change', function resultSelected(e) {
    document.querySelector('#subdivision').value = e.suggestion.county || '';
    document.querySelector('#municipality').value = e.suggestion.city || '';
    document.querySelector('#postal_code').value = e.suggestion.postcode || '';
    document.querySelector('#lat').value = e.suggestion.latlng['lat']  || '';
    document.querySelector('#lon').value = e.suggestion.latlng['lng']  || '';
  });
}

function init(){

  initVue();
  // addKeyUpListener();
  // uploadImg();
  // autocompleteAddress();
  serviceInfo();

  if ($('div').is('#flatShow')) {
    var lat = $('#lat').val();
    var lon = $('#lon').val();

    var coord = [lon, lat];
    var map = tt.map({
        container: 'map',
        key: 'GAQpTuIuymbvAGETW9Qf0GSfF1ub9G0r',
        style: 'tomtom://vector/1/basic-main',
        center: coord,
        zoom: 13
    });

    var marker = new tt.Marker().setLngLat(coord).addTo(map);
  }
}

$(document).ready(init);
