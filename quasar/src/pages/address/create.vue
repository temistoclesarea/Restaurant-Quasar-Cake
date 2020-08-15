<template>
  <q-page padding>
    <h1 class="q-display-2">
      <q-icon name="location_on"/> Novo Endereço
    </h1>

    <form @submit.prevent="submit()">


      <address-fields v-model="data"></address-fields>

      <q-btn type="submit" label="Salvar" color="primary" class="q-ma-md"/>

    </form>

  </q-page>
</template>

<script>
import AddressFields from '../../components/address_fields';

export default {
  data() {
    return {
      data: {},
    };
  },
  components: {
    'address-fields': AddressFields,
  },
  methods: {
    submit() {
      // console.log(this.data);
      this.$store.dispatch('address/create', { vue: this, data: this.data })
        .then(() => {
          this.$q.notify({
            message: 'Salvo com sucesso.',
            type: 'positive',
          });
        });
      this.$router.go(-1);
    },
  },
};
</script>

<style>
</style>
