<script id="flat-component" type="text/x-template">

  <div class="col-xs-12 col-md-6 col-lg-4" v-on:mouseover="setMouseIn(true)" v-on:mouseout="setMouseIn(false)">
    <div class="card">
      <img :src="img" class="card-img-top" alt="flat-img">
      <div class="card-body">
        <h5 class="card-title">@{{ title }}</h5>
        <p class="card-text text-muted">@{{ shortDesc }}</p>
        <a href="#" class="btn btn-primary">Visualizza</a>
      </div>
    </div>
  </div>

</script>

<script type="text/javascript">

  Vue.component('flatcomponent', {

    template: '#flat-component',

    data: function () {
      return {
        mouseIn: false
      }
    },

    props: {
      title: String,
      desc: String,
      img: String,
      id: String
    },

    methods: {
      setMouseIn: function(mouseIn) {
        this.mouseIn = mouseIn
      }
    },

    computed: {
      shortDesc: {
        get: function() {
          if (this.mouseIn) return this.desc;

          var res = this.desc.substring(0, 50).trim();
          return res + (this.desc.length > 50 ? '...' : '');
        }
      }
    }

  });

</script>
