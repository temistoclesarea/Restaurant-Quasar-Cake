<template>
  <q-page padding>
    <h1 class="q-display-2">
      Identificação
    </h1>

    <div class="row gutter-md">
      <div class="col-xs-12 col-md-6">
        <q-card>
          <q-card-main>
            <form @submit.prevent="auth()">
              <p class="caption">Já tenho conta</p>

              <q-field icon="email">
                <q-input
                type="email"
                v-model="dataLogin.email"
                float-label="Email"/>
              </q-field>

              <q-field icon="lock">
                <q-input
                type="password"
                v-model="dataLogin.password"
                float-label="Senha"/>
              </q-field>

              <q-field>
                <q-btn type="submit" color="primary" class="q-my-md">Acessar</q-btn>
                <!-- <q-btn color="primary" class="q-ma-md" @click="testar()">Testar</q-btn> -->
              </q-field>

            </form>
          </q-card-main>
        </q-card>
      </div>

      <div class="col-xs-12 col-md-6">
        <q-card>
          <q-card-main>
            <form @submit.prevent="register()">
              <p class="caption">Quero me cadastrar</p>

              <q-field icon="label">
                <q-input
                type="text"
                v-model="dataRegister.name"
                float-label="Name"
                autofocus/>
              </q-field>

              <q-field icon="email">
                <q-input
                type="email"
                v-model="dataRegister.email"
                float-label="Email"/>
              </q-field>

              <q-field icon="lock">
                <q-input
                type="password"
                v-model="dataRegister.password"
                float-label="Senha"/>
              </q-field>

              <q-field icon="lock_open">
                <q-input
                type="password"
                v-model="dataRegister.passwordConfirmation"
                float-label="Confirmação de senha"/>
              </q-field>

              <q-field>
                <q-btn type="submit" color="primary" class="q-my-md">Cadastrar</q-btn>
              </q-field>

            </form>
          </q-card-main>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import qs from 'qs';

export default {
  data() {
    return {
      dataLogin: {},
      dataRegister: {},
      token: null,
    };
  },
  methods: {
    /* async testar() {
      const response = await this.$axios.get('/users/me.json', {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      });
      console.log(response);
    }, */
    async auth() {
      if (!this.dataLogin.email || !this.dataLogin.password) {
        this.$q.notify({
          message: 'Email e Senha são obrigatórios',
          type: 'warning',
          textColor: 'black',
        });
        return;
      }

      const data = qs.stringify(this.dataLogin);
      const response = await this.$axios.post('/users/login.json', data);
      // console.log(response);
      // const token = response.data.data.token; error Use object destructuring
      // é necessario alterar o padrão para o informado abaixo
      // é a mesma coisa, só que um é atalho do outro, mas mesmo assim
      // o outro da erro.
      const { token } = response.data.data; // cria variavel token com o valor dentro
      // console.log(token);
      this.token = token;
      // cria o cookie com o token gerado
      this.$q.cookies.set('token', token);
      // todas as requisições que forem feitas, será utilizando esse cabeçalho
      this.$axios.defaults.headers.common.Authorization = `Bearer ${token}`;

      if (response.status === 200) {
        this.$q.notify({
          message: 'Autenticado com sucesso',
          type: 'positive',
        });
      }

      this.$router.push('/');
    },

    async register() {
      if (!this.dataRegister.password
      || this.dataRegister.password
      !== this.dataRegister.passwordConfirmation) {
        this.$q.notify({
          message: 'As senhas não conferem',
          type: 'negative',
        });
        return;
      }
      const data = qs.stringify(this.dataRegister);
      const response = await this.$axios.post('/users/add.json', data);
      // console.log(response);

      if (response.status === 200) {
        this.$q.notify({
          message: 'Cadastrado com sucesso',
          type: 'positive',
        });
      }
    },
  },
};
</script>

<style>
</style>
