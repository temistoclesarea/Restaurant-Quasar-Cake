<template>
  <q-page padding>
    <h1 class="q-display-2">
      Editando restaurante
    </h1>
    <form @submit.prevent="submit()" class="row gutter-md">
      <div class="col-12">
        <q-field icon="label">
          <q-input
            type="text"
            v-model="data.title"
            float-label="Nome do restaurante"
            autofocus/>
        </q-field>
      </div>

      <div class="col-12">
        <q-field icon="insert_photo">
          <q-uploader
            url=""
            hide-upload-button
            float-label="Foto do restaurante"
            @add="addFile"/>
        </q-field>
      </div>

      <div class="col-6">
        <q-field icon="timer">
          <q-input
            type="text"
            v-model="data.delivery_time"
            float-label="Tempo de entrega"/>
        </q-field>
      </div>

      <div class="col-6">
        <q-field icon="attach_money">
          <q-input
            type="text"
            v-model="data.delivery_price"
            float-label="Valor da entrega"/>
        </q-field>
      </div>

      <div class="col-12">
        <h2 class="q-display-1 text-left">Endereço</h2>
        <address-fields v-model="address"></address-fields>
      </div>

      <div class="col-12">
        <q-field>
          <q-btn type="submit" color="primary" class="q-ma-sm">Salvar</q-btn>
          <q-btn type="submit" color="secondary" class="q-ma-sm" to="/restaurants">Voltar</q-btn>
        </q-field>
      </div>
    </form>
  </q-page>
</template>

<script>
import AddressFields from '../../components/address_fields';

export default {
  data() {
    return {
      formData: null,
    };
  },
  components: {
    'address-fields': AddressFields,
  },
  computed: {
    data() {
      return this.$store.state.restaurants.current;
    },
    address: {
      get() {
        return this.$store.state.restaurants.current.address || {};
      },
      set(newValue) {
        this.data.address = newValue;
        this.$store.commit('restaurants/setCurrent', this.data);
      },
    },
  },
  methods: {
    addFile(files) {
      this.formData.append('photo', files[0]);
    },
    async submit() {
      // console.log('form enviado');
      Object.keys(this.data).forEach(key => this.formData.append(key, this.data[key]));
      Object.keys(this.address).forEach(key => this.formData.append(key, this.address[key]));

      await this.$store.dispatch('restaurants/edit',
        { vue: this, data: this.formData, id: this.$route.params.id });

      this.$q.notify({
        message: 'Restaurante alterado com sucesso',
        type: 'positive',
      });
    },
  },
  mounted() {
    this.formData = new FormData();
    this.$store.dispatch('restaurants/current', { vue: this, id: this.$route.params.id });
  },
};
</script>

<style>
</style>
