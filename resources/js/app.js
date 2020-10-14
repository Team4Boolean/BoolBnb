// Require List
require('./bootstrap');

window.Vue = require('vue');

window.$ = require('jquery');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
});



// FORM FLAT-CREATE

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
function uploadImg(){

  $("#imgInp").change(function() {
    readURL(this);
  });

}

function init(){
  uploadImg();
}

$(document).ready(init);
