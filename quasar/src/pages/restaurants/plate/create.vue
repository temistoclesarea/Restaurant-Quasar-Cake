<template>
  <q-page padding>
    <h1 class="q-display-2">
      Cadastre seu prato
    </h1>
    <form @submit.prevent="submit()" class="row gutter-md">
      <div class="col-12">
        <q-field icon="label">
          <q-input
            type="text"
            v-model="data.title"
            float-label="Nome do prato"
            autofocus/>
        </q-field>
      </div>

      <div class="col-12">
        <q-field icon="insert_photo">
          <q-uploader
            stack-label="Foto do prato"
            hide-upload-button
            url=""
            @add="addFile" />
        </q-field>
      </div>

      <div class="col-12">
        <q-field icon="description">
          <q-input
            type="text"
            v-model="data.description"
            float-label="Descrição do prato"/>
        </q-field>
      </div>

      <div class="col-6">
        <q-field icon="attach_money">
          <q-input
            type="text"
            v-model="data.price"
            float-label="Valor do prato"/>
        </q-field>
      </div>

      <div class="col-12">
        <q-card>
          <q-card-main>
            <div class="q-card-title">
              Opções do prato
            </div>

            <q-alert
              v-if="options.length === 0"
              color="warning"
              text-color="black"
              class="q-mt-sm">
              Nenhuma opção para esse prato.
            </q-alert>

            <ul v-show="options.length > 0">
              <li class="q-my-sm" v-for="(opt, i) in options" :key="i">
                <q-btn size="sm" color="red" @click="optionsDelete(i)">x</q-btn> {{ opt }}
              </li>
            </ul>

            <q-field icon="exposure_plus_1">
              <q-input
                type="text"
                v-model="optionLabel"
                float-label="Adicionar para o prato"/>
                <q-btn color="primary" class="q-mt-md" @click="optionsAdd()">Adicionar</q-btn>
            </q-field>
          </q-card-main>
        </q-card>
      </div>

      <div class="col-6">
        <q-field>
          <q-btn type="submit" color="primary" class="q-ma-sm">Salvar</q-btn>
          <q-btn
            type="submit"
            color="secondary"
            class="q-ma-sm"
            to="/restaurant/1/detail">Voltar</q-btn>
        </q-field>
      </div>
    </form>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      data: {},
      options: [],
      optionLabel: null,
      formData: null,
    };
  },
  methods: {
    addFile(files) {
      this.formData.append('photo', files[0]);
    },
    async submit() {
      /* data {
        chave1: valor1,
        chave2: valor2,
      }
      const lista = Object.keys(data);
      lista [
        'chave1',
        'chave2',
      ] */
      Object.keys(this.data).forEach(key => this.formData.append(key, this.data[key]));
      this.formData.append('restaurant_id', this.$route.params.id);
      this.formData.append('options', JSON.stringify(this.options));

      await this.$store.dispatch('plates/create', { vue: this, data: this.formData });
      // console.log('form enviado');
      this.$q.notify({
        message: 'Prato cadastrado com sucesso',
        type: 'positive',
      });

      this.$router.push(`/restaurant/${this.$route.params.id}/detail`);
    },
    optionsDelete(i) {
      this.options.splice(i, 1); // removendo só o item atual
    },
    optionsAdd() {
      if (this.optionLabel === null) {
        this.$q.notify({
          message: 'Por favor, informe um título para a opção',
        });
        return;
      }
      this.options.push(this.optionLabel);
      this.optionLabel = null;
    },
  },
  mounted() {
    this.formData = new FormData();
  },
};
</script>

<style>
</style>
