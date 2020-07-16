<template>
  <q-page padding>
    <h1 class="q-display-2">
      Carrinho de compras
    </h1>
    <q-card class="q-mb-sm" v-for="i in 4" :key="i">
      <q-card-main class="row">
        <div class="col-md-1 col-xs-2">
          <img src="~assets/user-icon-vector.jpg" alt="avatar"
          style="width:50px;" class="round-borders">
        </div>
        <div class="col flex items-center">
          Nome do produto
        </div>
        <div class="col-md-4 flex items-center justify-end">
          {{ i }} <q-btn color="green" class="q-mx-md">+</q-btn>
          <q-btn color="red" class="q-mr-md">-</q-btn>
        </div>
        <div class="col-2 flex items-center justify-end">
          R$ 10,00
        </div>
      </q-card-main>
    </q-card>

    <div class="row">
      <q-card class="col-xs-12 col-md-6 offset-md-6 text-black text-right" color="grey-3">
        <q-card-main>
          Entrega: R$ 5,00
        </q-card-main>
        <q-card-main>
          Pedido: R$ 40,00
        </q-card-main>
        <q-card-main>
          Entrega: R$ 45,00
        </q-card-main>
        <q-card-actions class="flex justify-end">
          <q-btn color="green" label="Fechar pedido" @click="buy()"/>
        </q-card-actions>
      </q-card>
    </div>
  </q-page>
</template>

<script>
export default {
  methods: {
    buy() {
      // console.log('buy');
      this.$q.actionSheet({
        title: 'Escolha o endereço',
        actions: [
          {
            label: 'R. XXX, 100 - centro - Teresina - Cep 64.000-000',
            icon: 'add_location',
            color: 'green',
            handler: () => {
              this.$router.push('/order/1');
            },
          },
          {
            label: 'R. YYY, 10 - centro - Teresina - Cep 64.000-000',
            icon: 'add_location',
            color: 'green',
            handler: () => {
              this.$router.push('/order/2');
            },
          },
          {
            label: 'R. ZZZ, 101 - leste - Teresina - Cep 64.000-000',
            icon: 'add_location',
            color: 'green',
            handler: () => {
              this.$router.push('/order/3');
            },
          },
          {},
          {
            label: 'Adicionar novo endereço',
            icon: 'add_circle',
            handler: () => {
              this.$router.push('/address/create');
            },
          },
        ],
      });
    },
  },
};
</script>

<style>
</style>
