<template>
  <q-page padding>
    <h1 class="q-display-2">
      <q-icon name="location_on"/> Restaurantes próximos a você
    </h1>
    <p class="text-grey">{{ $route.params.location }}</p>
    <p><q-btn to="/" color="primary" label="Trocar localização" /></p>
    <div class="row gutter-lg">
      <div class="col-xs-6 col-md-4" v-for="(restaurant, i) in restaurants" :key="i">
        <q-card>
          <q-card-media>
            <img :src="`http://localhost:8765/uploader/restaurants/${restaurant.photo}`"/>
            <q-card-title slot="overlay">
              {{ restaurant.title }}
              <span slot="subtitle">Entrega em {{ restaurant.delivery_time }}</span>
            </q-card-title>
          </q-card-media>
          <q-card-separator/>
          <q-card-main>
            <q-icon name="star" v-for="i in star_range(3.5).full" :key="i"/>
            <q-icon name="star_half" v-for="i in star_range(3.5).half" :key="i*5"/>
            <q-icon name="star_border" v-for="i in star_range(3.5).empty" :key="i*10"/>
          </q-card-main>
          <q-card-actions>
            <q-btn :to="'/restaurant/' + restaurant.id" flat color="primary" label="Ver cardápio"/>
          </q-card-actions>
        </q-card>
      </div>

    </div>
  </q-page>
</template>

<script>
export default {
  computed: {
    restaurants() {
      return this.$store.state.restaurants.list;
    },
  },
  methods: {
    star_range(rate) {
      const full = Math.trunc(rate); /* Math.trunc arredonda o valor */
      let half = 0;
      if (rate % 1 !== 0) {
        half = 1;
      }
      const empty = 5 - (full + half);
      return {
        full,
        half,
        empty,
      };
    },
  },
  mounted() {
    // this.$axios.get(`/restaurants/search.json?term=${this.$route.params.location}`);
    this.$store.dispatch('restaurants/search', { vue: this, term: this.$route.params.location });
  },
};
</script>

<style>
</style>
