<template>
  <q-page padding>
    <h1 class="q-display-2">
      <q-icon name="location_on"/> Novo Endereço
    </h1>

    <form @submit.prevent="submit()">
      <q-field>
        <q-input
          type="text"
          maxlength="8"
          v-model="cep"
          float-label="Informe o CEP"
          autofocus
        />
      </q-field>

        <div v-show="showAddressFields">
          <q-field>
            <q-input
              type="text"
              v-model="data.address"
              float-label="Informe o logradouro"
            />
          </q-field>

          <q-field>
            <q-input
              type="text"
              v-model="data.number"
              float-label="Informe o número"
            />
          </q-field>

          <q-field>
            <q-input
              type="text"
              v-model="data.complement"
              float-label="Informe o complemento"
            />
          </q-field>

          <q-field>
            <q-input
              type="text"
              v-model="data.neiborhood"
              float-label="Informe o bairro"
            />
          </q-field>

          <q-field>
            <q-input
              type="text"
              v-model="data.city"
              float-label="Informe o cidade"
            />
          </q-field>

          <q-field>
            <q-input
              type="text"
              v-model="data.state"
              float-label="Informe o estado"
            />
          </q-field>

          <q-btn type="submit" label="Salvar" color="primary" class="q-my-md"/>

        </div>

    </form>

  </q-page>
</template>

<script>
export default {
  data() {
    return {
      cep: null, // essa variavel vai ser observada pelo "watch"
      data: {},
      showAddressFields: false,
    };
  },
  watch: {
    cep(newValue) {
      if (newValue.length === 8) {
        this.showAddressFields = true;
      } else {
        this.showAddressFields = false;
      }
    },
  },
  methods: {
    submit() {
      console.log('Enviar');
    },
  },
};
</script>

<style>
</style>
