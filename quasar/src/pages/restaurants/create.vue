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
      data: {},
      address: {},
      formData: null,
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
    addFile(file) {
      // console.log(file);
      this.formData.append('photo', file[0]); // adiciona o arquivo para upload
    },
    async submit() {
      // pega todas as chaves do objeto this.data e criar um array
      // depois percorre cada item e adiciona a chave de data
      Object.keys(this.data).forEach(key => this.formData.append(key, this.data[key]));
      Object.keys(this.address).forEach(key => this.formData.append(key, this.address[key]));
      // async await - aguarda o store terminar para passar para o proximo passo
      await this.$store.dispatch('restaurants/create', { vue: this, data: this.formData });
      // console.log('form enviado');
      this.$q.notify({
        message: 'Restaurante adicionado com sucesso',
        type: 'positive',
      });

      this.$router.push('/restaurants');
    },
  },
  mounted() {
    // envia dados de formulario, suporte oficial para envio de formulario
    this.formData = new FormData();
  },
};
</script>

<style>
</style>
