<script id="flat-component" type="text/x-template">

  <div class="col-xs-12 col-md-6 col-xl-4 mb-3 " v-on:mouseover="setMouseIn(true)" v-on:mouseout="setMouseIn(false)">
    <div style=" height: 400px" class="card shadow">
      <img style=" height: 140px" :src="img" class="card-img-top" alt="flat-img">
      <div class="card-body" style=" position: reltive;">
        <h5 class="card-title">@{{ title }}</h5>
        <p class="card-text text-muted">@{{ shortDesc }}</p>
        <!-- <p class="text-danger">@{{ printSponsored(sponsored) }}</p> -->
        <a :href="show" class="btn " style=" position: absolute; bottom: 10px; left: 10px;">Visualizza</a>
      </div>
    </div>
  </div>

</script>

<script type="text/javascript">

  Vue.component('flatcomponent', {

    template: '#flat-component',

    data: function () {
      return {
        mouseIn: false,
        show: '/flats/'+this.id+'/show'
      }
    },

    props: {
      title: String,
      desc: String,
      img: String,
      sponsored: String,
      id: String
    },

    methods: {
      setMouseIn: function(mouseIn) {
        this.mouseIn = mouseIn;
      },
      printSponsored: function(sponsored) {
        if (sponsored != "") {
          console.log(sponsored);
          return message = "In evidenza";
        } else {
          return message = "";
        }
      }
    },

    computed: {
      shortDesc: {
        get: function() {

          if (this.mouseIn) return this.desc;

          var res = this.desc.substring(0, 80).trim();
          return res + (this.desc.length > 80 ? '...' : '');
        }
      }
    }

  });

</script>
