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
                v-model="data.email"
                float-label="Email"/>
              </q-field>

              <q-field icon="lock">
                <q-input
                type="password"
                v-model="data.password"
                float-label="Senha"/>
              </q-field>

              <q-field>
                <q-btn type="submit" color="primary" class="q-my-md">Acessar</q-btn>
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
                v-model="data.name"
                float-label="Name"
                autofocus/>
              </q-field>

              <q-field icon="email">
                <q-input
                type="email"
                v-model="data.email"
                float-label="Email"/>
              </q-field>

              <q-field icon="lock">
                <q-input
                type="password"
                v-model="data.password"
                float-label="Senha"/>
              </q-field>

              <q-field icon="lock_open">
                <q-input
                type="password"
                v-model="data.passwordConfirmation"
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
export default {
  data() {
    return {
      data: {},
    };
  },
  methods: {
    auth() {
      this.$q.notify({
        message: 'Autenticado com sucesso',
        type: 'positive',
      });
    },
    register() {
      this.$q.notify({
        message: 'Cadastrado com sucesso',
        type: 'positive',
      });
    },
  },
};
</script>

<style>
</style>
