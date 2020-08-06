<template>
  <q-page padding class="bg-food">
    <div class="flex flex-center">
      <!--<img alt="logo" src="~assets/food-outline.png">-->
      <h1 class="q-display-3 text-center q-py-xl text-green-5">Bem Vindo!</h1>
    </div>

    <div class="row gutter-xs" padding>

      <div class="col-xs-12 col-sm-4">
        <q-card color="green">
          <q-card-title>
            <q-icon name="location_on"/> Pegar localização atual
          </q-card-title>
          <q-card-separator/>
          <q-card-main>
            Próximo de {{ currentPosition }}
          </q-card-main>
          <q-card-actions>
            <q-btn @click="getCurrentPosition()" flat label="Ver restaurantes"/>
          </q-card-actions>
        </q-card>
      </div>

      <div class="col-xs-12 col-sm-4">
        <q-card color="primary">
          <q-card-title>
            <q-icon name="account_box"/> Acessar sua conta
          </q-card-title>
          <q-card-separator/>
          <q-card-main>
            Você pode pedir usando um endereço já existente, acesse sua conta para começar
          </q-card-main>
          <q-card-actions>
            <q-btn to="/list-restaurants" flat label="Acessar Conta"/>
          </q-card-actions>
        </q-card>
      </div>

      <div class="col-xs-12 col-sm-4">
        <q-card color="orange">
          <q-card-title>
            <q-icon name="fastfood"/> Escolher localização
          </q-card-title>
          <q-card-separator/>
          <q-card-main>
            <q-btn
              to="/list-restaurants"
              color="white"
              text-color="primary"
              size="md"
              class="q-mr-md q-mb-md"
              :label="place"
              v-for="(place, index) in places"
              :key="index"
            />
          </q-card-main>
        </q-card>
      </div>

    </div>
  </q-page>
</template>

<style>
  h2 {
    text-align: center;
  }
  .bg-food {
    background: url("~assets/cafe-da-manha-2.jpg") no-repeat;
    background-size: contain;
  }
</style>

<script>
export default {
  name: 'PageIndex',
  data() {
    return {
      currentPosition: '...',
      currentAddressComponents: [],
      selectedPosition: null,
      places: [
        'Cidade 1',
        'Cidade 2',
        'Bairro 1',
        'Bairro 2',
        'Bairro 3',
      ],
    };
  },
  mounted() {
    navigator.geolocation.getCurrentPosition(this.showLocation);
  },
  methods: {
    async showLocation(position) {
      // evita erro de cors e remove authorization
      const removeAuthHeader = (data, headers) => {
        delete headers.common.Authorization;
        return data;
      };

      const lat = position.coords.latitude;
      const lon = position.coords.longitude;
      const key = 'AIzaSyAmPoSRGtztI_bD99gGZLfzZ424Qt-9o1c';
      // console.log(lat, lon, key);
      // não vai pegar o response pois a apigeocode exige informações de faturamento
      // que necessita ser cadastrado no google
      const response = await this.$axios.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lon}&key=${key}`, {
        transformRequest: [removeAuthHeader],
      });
      let { results } = response.data;
      results = results[0] || {};
      this.currentPosition = results.formatted_address;
      // console.log(results);
      const addressComponents = results.address_components || [];
      // console.log(addressComponents);
      addressComponents.forEach((data) => {
        if (data.types.indexOf('sublocality_level_1') >= 0 || data.types.indexOf('administrative_area_level_2') >= 0) {
          this.currentAddressComponents.push({
            label: data.long_name,
            value: data.long_name,
          });

          if (this.selectedPosition === null) {
            this.selectedPosition = data.long_name;
          }
        }
      });
    },
    getCurrentPosition() {
      this.$q.dialog({
        title: 'Escolha um local',
        options: {
          type: 'radio',
          model: this.selectedPosition,
          items: this.currentAddressComponents,
          /* items: [
            { label: 'Cidade', value: 'cidade' },
            { label: 'Bairro', value: 'bairro' },
          ], */
        },
      }).then((data) => {
        this.$router.push(`/list-restaurants/${data}`);
      });
    },
  },
};
</script>
