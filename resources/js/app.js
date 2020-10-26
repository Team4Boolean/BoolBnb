
require('./bootstrap');

window.Vue = require('vue');

window.$ = require('jquery');

$.fn.extend({
 trackChanges: function() {
   $(":input",this).change(function() {
      $(this.form).data("changed", true);
   });
 }
 ,
 isChanged: function() {
   return this.data("changed");
 }
});

// window.Dropzone = require('dropzone');

//da qua parte chart.js
var Chart = require('chart.js');

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

  var button = $('.get-coord');

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
}

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
    showPreview();
  });

}

// AUTOCOMPLETAMENTO DELL'INDIRIZZO
function autocompleteAddress() {

  if ($('div').is('.jumbotron') || $('div').is('.flatsearch')) {
    var places = require('places.js');
    var placesAutocomplete = places({
      appId: 'plXJIJDQMD75',
      apiKey: '55b0a2a2464a36ae6c8b7c5436ea0ec8',
      container: document.querySelector('#jumbo-search-bar')

    });

    placesAutocomplete.on('change', function resultSelected(e) {
    //   document.querySelector('#subdivision').value = e.suggestion.county || '';
    //   document.querySelector('#municipality').value = e.suggestion.city || '';
    //   document.querySelector('#postal_code').value = e.suggestion.postcode || '';
      document.querySelector('#jumbo-search-lat').value = e.suggestion.latlng['lat']  || '';
      document.querySelector('#jumbo-search-lon').value = e.suggestion.latlng['lng']  || '';
    });
    } else {
        var places = require('places.js');
        var placesAutocomplete = places({
          appId: 'plXJIJDQMD75',
          apiKey: '55b0a2a2464a36ae6c8b7c5436ea0ec8',
          container: document.querySelector('#search-bar')

        });

        placesAutocomplete.on('change', function resultSelected(e) {
        //   document.querySelector('#subdivision').value = e.suggestion.county || '';
        //   document.querySelector('#municipality').value = e.suggestion.city || '';
        //   document.querySelector('#postal_code').value = e.suggestion.postcode || '';
          document.querySelector('#search-lat').value = e.suggestion.latlng['lat']  || '';
          document.querySelector('#search-lon').value = e.suggestion.latlng['lng']  || '';
        });
      }
    }

// ADVERTISINGS - CHARTS

// function flatCharts(){
//   var Chart = require('chart.js'); //da qua parte chart.js
//
//   var ctx = $("#viewsChart");
//
//   var viewsChart = new Chart(ctx, {
//     type: 'bar',
//     data:  {
//       labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//       datasets: [{
//         label: '# of Votes',
//         data: [12, 19, 3, 5, 2, 3],
//         backgroundColor: [
//           'rgba(255, 99, 132, 0.2)',
//           'rgba(54, 162, 235, 0.2)',
//           'rgba(255, 206, 86, 0.2)',
//           'rgba(75, 192, 192, 0.2)',
//           'rgba(153, 102, 255, 0.2)',
//           'rgba(255, 159, 64, 0.2)'
//         ],
//         borderColor: [
//           'rgba(255, 99, 132, 1)',
//           'rgba(54, 162, 235, 1)',
//           'rgba(255, 206, 86, 1)',
//           'rgba(75, 192, 192, 1)',
//           'rgba(153, 102, 255, 1)',
//           'rgba(255, 159, 64, 1)'
//         ],
//         borderWidth: 1
//       }],
//     },
//
//     options:  {
//       scales: {
//           yAxes: [{
//               ticks: {
//                   beginAtZero: true
//               }
//           }]
//         },
//       },
//   });
// }

function init(){

  // initVue();
  addKeyUpListener();
  uploadImg();
  autocompleteAddress();
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
        zoom: 11
    });

    var marker = new tt.Marker().setLngLat(coord).addTo(map);
  }
}


$(document).ready(init);
