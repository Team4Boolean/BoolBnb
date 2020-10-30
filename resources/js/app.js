
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

// FLAT_SEARCH

function addCheckboxChangeListener()  {

  var target = $('.checkInput').find('input');
    target.change(function(){
    searchFlat();
  });
}

function addSelectChangeListener()  {

  var target = $('.numInput').find('select');

  target.change(function(){
    searchFlat();
  });
}

function searchFlat() {

  var lat = $('input[name ="lat"]').val();
  var lon = $('input[name ="lon"]').val();
  var loc = $('input[name ="loc"]').val();
  var distance = $('select[name ="distance"]').val();
  var rooms = $('select[name ="rooms"]').val();
  var beds = $('select[name ="beds"]').val();
  var services = [];

  $('input[name ="services[]"]').each(function() {
    var me = $(this);
    var isChecked = me.is(':checked');
    var val = $(this).val();

    if (isChecked) {
      services.push(val);
    }
  });

  console.log(lat);
  console.log(lon);
  console.log(loc);
  console.log(distance);
  console.log(rooms);
  console.log(beds);
  console.log(services);



  $.ajax ({
   url : '/api/flats/search',
   method : 'GET',
   data : {
   'loc': loc,
   'lon': lon,
   'lat': lat,
   'distance': distance,
   'rooms': rooms,
   'beds': beds,
   'services':services
  },
    success : function(flats) {

    console.log('appartamenti',flats);

    var target = $('#results');
    target.html('');
    $('#search-result').text('');

      if (flats.length > 0) {

        $('#search-result').text(flats.length + ' risultati');

        for (var i = 0; i < flats.length; i++) {

            var flat = flats[i];
            var desc = flat['desc'];
            var descShort = desc.substr(0, 80);

            var url = flat['url'];
            if (url.substr(0,4) == 'http') {
              var src = url;
            } else {
              var src = 'http://localhost:8000/storage/' + url;
            }

            if (flat['sponsored'] != null) {
              $('.media').toggleClass('table-warning');
              var sponsored = "In evidenza";
            } else {
              $('.media').toggleClass('table-warning');
              var sponsored = "";
            }
            console.log(flat);
            // var component = '<div class=" col-md-6 col-lg-12 offset-xl-1 col-xl-5 mb-3 "><div style=" height: 400px" class="card shadow"><img style=" height: 140px" src="' + src + '" class="card-img-top" alt="flat-img"><div class="card-body" ><h5 class="card-title">' + flat['title'] + '</h5><p class="card-text text-muted">'+ descShort +'</p><p class="text-danger">' + sponsored + '</p><a href="/flats/'+ flat['id']+'/show" class="btn " style=" position: absolute; bottom: 10px; left: 10px;">Visualizza</a></div></div></div>';

            var component = '<div class="media mb-3 col-12"><img height="150px" width="auto" src="' + src + '" class="m-3" alt="' + flat['url'] + '"><div class="media-body m-3 d-flex flex-column justify-content-between"><div class="d-flex justify-content-between"><h5 class="mt-0">' + flat['title'] + '</h5><div class="text-danger">' + sponsored + '</div></div><div class="text-muted">'+ descShort +'</div><div class="align-self-end"><a href="/flats/'+ flat['id']+'/show" class="btn">Visualizza</a></div></div></div>'

            target.append(component);
          }
      } else {
        var warning = "<h3>Nessun appartamento trovato</h3>";
        target.append(warning);
      }

   },
   error: function(request, state, error) {
     console.log('request' , request);
     console.log('state' , state);
     console.log('error' , error);
   }

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


  function navbarScroll() {
    $(window).scroll(function(){
      $('.jumbo-navbar').toggleClass('scrolled', $(this).scrollTop() > 80);
    });
  }

  function navbarScroll2() {
    $(window).scroll(function(){
      $('.search-bar').toggleClass('scrolled2', $(this).scrollTop() > 210);
    });
  }

function init(){

  // initVue();
  addKeyUpListener();
  uploadImg();
  autocompleteAddress();
  serviceInfo();

  // navbar scroll
  navbarScroll();
  navbarScroll2();

  addCheckboxChangeListener();
  addSelectChangeListener();
}


$(document).ready(init);
