<script id="fsc-component" type="text/x-template">

  <div class="media mb-3 col-12" v-on:mouseover="setMouseIn(true)" v-on:mouseout="setMouseIn(false)" v-bind:class="{ 'table-warning': isSponsored }">
    <img height="150px" width="auto" :src="img" class="m-3" alt="Immagine prova">
    <div class="media-body m-3 d-flex flex-column justify-content-between">
      <div class="d-flex justify-content-between">
        <h5 class="mt-0">@{{ title }}</h5>
        <div class="text-danger">
          @{{ printSponsored(sponsored) }}
        </div>
      </div>
      <div class="text-muted">
        @{{ shortDesc}}
      </div>
      <div class="align-self-end">
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
