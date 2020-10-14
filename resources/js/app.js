// Require List
require('./bootstrap');

window.Vue = require('vue');

window.$ = require('jquery');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



// FORM flat-create

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
  console.log('eccomi');
}

$(document).ready(init);
