<script id="fsc-component" type="text/x-template">

  <div class="col-12 mb-2 p-0" v-on:mouseover="setMouseIn(true)" v-on:mouseout="setMouseIn(false)" v-bind:class="{ 'table-warning': isSponsored }">

    <div class="row">
      <div class="col-md-6 col-lg-12 col-xl-4 p-0">
        <img height="150px" width="100%" :src="img" :alt="title">
      </div>
      <div class="col-md-6 col-lg-12 col-xl-8 p-2" >
        <div class="d-flex justify-content-between">
          <h5 class="mt-0">@{{ title }}</h5>
          <div class="text-danger">
            @{{ printSponsored(sponsored) }}
          </div>
        </div>
        <div class="text-muted">
          @{{ shortDesc}}
        </div>
        <a :href="show" class="btn">Visualizza</a>
      </div>
    </div>

  </div>

</script>

<script type="text/javascript">

  Vue.component('fsc', {

    template: '#fsc-component',

    data: function () {
      return {
        mouseIn: false,
        show: '/flats/'+this.id+'/show',
        isSponsored: false
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
          this.isSponsored = true;
          return message = "In evidenza";
        } else {
          return message = "";
        }
      }
    },

    computed: {
      shortDesc: {
        get: function() {

          // if (this.mouseIn) return this.desc;

          var res = this.desc.substring(0, 80).trim();
          return res + (this.desc.length > 80 ? '...' : '');
        }
      }
    }

  });

</script>
