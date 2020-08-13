<template>
  <q-page padding>
    <h1 class="q-display-2">
      <q-icon name="location_on"/> {{ restaurant.title }}
    </h1>
    <p class="q-mb-lg"><span class="text-amber"><q-icon name="star"/> 3.5</span> |
    <span class="text-grey">Entrega em {{ restaurant.delivery_time }} -
      valor da entrega: R$ {{ restaurant.delivery_price }}</span></p>
    <p><q-btn to="/" color="primary" label="Trocar localização" /></p>
    <div class="row gutter-lg">
      <div class="col-xs-12 col-md-6" v-for="(plate, i) in plates" :key="i">
        <q-card>
          <q-card-media>
            <img :src="'http://localhost:8765/uploader/plates/' + plate.photo"/>
            <q-card-title>
              {{ plate.title }}
              <span slot="subtitle">R$ {{ plate.price }}</span>
            </q-card-title>
          </q-card-media>
          <q-card-separator/>
          <q-card-main>
            {{ plate.description }}
          </q-card-main>
          <q-card-actions>
            <q-btn flat color="primary" label="Pedir" @click="order(plate)"/>
          </q-card-actions>
        </q-card>
      </div>

    </div>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      opt: [],
    };
  },
  methods: {
    order(plate) {
      const options = [];

      plate.plate_options.forEach((data) => {
        options.push({
          label: data.title,
          value: data.title,
        });
      });

      this.$q.dialog({
        title: 'Confirmar pedido',
        options: {
          type: 'checkbox',
          model: this.opt,
          items: options,
        },
      }).then(async (data) => { /* executando quando confirma a ação */
        // console.log(data);
        this.opt = data; /* já deixa a opção marcada */
        plate.options = data;
        await this.$store.dispatch('cart/add', plate);
        this.$store.dispatch('cart/list');
      });
    },
  },
  computed: {
    restaurant() {
      return this.$store.state.restaurants.current;
    },
    plates() {
      return this.$store.state.plates.list;
    },
  },
  mounted() {
    this.$store.dispatch('restaurants/current', { vue: this, id: this.$route.params.id });
    this.$store.dispatch('plates/all', { vue: this, id: this.$route.params.id });
    this.$store.dispatch('cart/current', this.$route.params.id);
  },
};
</script>

<style>
</style>
