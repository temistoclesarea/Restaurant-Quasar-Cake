<template>
  <div id="q-app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      request_counter: 0,
    };
  },
  watch: {
    request_counter(counter) {
      if (counter > 0) {
        console.log(counter);
        this.$q.loading.show({
          message: 'Consultando o servidor',
        });
      } else {
        console.log(counter);
        this.$q.loading.hide();
      }
    },
  },
  methods: {
    request_subtract() { // foi criado para não subtrair consecutivamente
      if (this.request_counter > 0) {
        this.request_counter -= 1;
      }
    },
  },
  mounted() { // callback de montagem do ciclo de vida do vuejs
    if (this.$q.cookies.has('token')) {
      const token = this.$q.cookies.get('token');
      // todas as requisições que forem feitas, será utilizando esse cabeçalho
      this.$axios.defaults.headers.common.Authorization = `Bearer ${token}`;
    }

    // interceptador de requisição
    this.$axios.interceptors.request.use((config) => {
      this.request_counter += 1;
      return config;
    }, (error) => {
      this.request_subtract();
      return Promise.reject(error);
    });

    // interceptador de resposta - encerrar a requisição
    this.$axios.interceptors.response.use((response) => {
      this.request_subtract();
      return response;
    }, (error) => {
      this.request_subtract();
      return Promise.reject(error);
    });
  },
};
</script>

<style>
</style>
