<template>
  <q-page padding>
    <h1 class="q-display-2">
      Cadastre seu restaurante
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
          <q-input
            type="text"
            v-model="data.photo"
            float-label="Foto do restaurante"/>
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
      data: {},
      address: {},
    };
  },
  components: {
    'address-fields': AddressFields,
  },
  watch: {
    address(newValue) {
      console.log(newValue);
    },
  },
  methods: {
    submit() {
      // console.log('form enviado');
      this.$q.notify({
        message: 'Restaurante adicionado com sucesso',
        type: 'positive',
      });
    },
  },
};
</script>

<style>
</style>
