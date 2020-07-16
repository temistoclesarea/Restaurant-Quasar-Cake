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
        <q-field>
          <q-btn type="submit" color="primary">Salvar</q-btn>
        </q-field>
      </div>
    </form>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      data: {
        //
      },
    };
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
