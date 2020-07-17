<template>
  <q-page padding>
    <h1 class="q-display-2">
      <q-icon name="location_on"/> Restaurantes próximos a você
    </h1>
    <p class="text-grey">Teresina</p>
    <p><q-btn to="/" color="primary" label="Trocar localização" /></p>
    <div class="row gutter-lg">
      <div class="col-xs-6 col-md-4" v-for="i in 5" :key="i">
        <q-card>
          <q-card-media>
            <img src="~assets/cafe-da-manha.jpg"/>
            <q-card-title slot="overlay">
              Nome do Restaurante
              <span slot="subtitle">Entrega em 30-40 min</span>
            </q-card-title>
          </q-card-media>
          <q-card-separator/>
          <q-card-main>
            <q-icon name="star" v-for="i in star_range(3.5).full" :key="i"/>
            <q-icon name="star_half" v-for="i in star_range(3.5).half" :key="i"/>
            <q-icon name="star_border" v-for="i in star_range(3.5).empty" :key="i"/>
          </q-card-main>
          <q-card-actions>
            <q-btn to="/restaurant/1" flat color="primary" label="Ver cardápio"/>
          </q-card-actions>
        </q-card>
      </div>

    </div>
  </q-page>
</template>

<script>
export default {
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
};
</script>

<style>
</style>
