<template>
  <q-layout view="hHh lpr lFf">
    <q-layout-header>
      <q-toolbar
        color="green"
        :glossy="$q.theme === 'mat'"
        :inverted="$q.theme === 'ios'"
      >
        <q-btn
          flat
          dense
          round
          @click="leftDrawerOpen = !leftDrawerOpen"
          aria-label="Menu"
        >
          <q-icon name="menu" />
        </q-btn>

        <q-toolbar-title>
          Restaurante Online
          <!--<div slot="subtitle">Running on Quasar v{{ $q.version }}</div>-->
        </q-toolbar-title>
        <q-btn flat to="/cart">
          <transition enter-active-class="animated tada" leave-active-class="hidden">
            <!-- daneden.github.io/animate.css -->
            <q-chip icon="shopping_cart" :key="cart_count">{{ cart_count }}</q-chip>
          </transition>
        </q-btn>
      </q-toolbar>
    </q-layout-header>

    <q-layout-drawer
      v-model="leftDrawerOpen"
      :content-class="$q.theme === 'mat' ? 'bg-green-1' : null"
      id=""
    >
      <q-list
        no-border
        link
        inset-delimiter
      >
        <q-item>
          <img class="logo" src="~assets/food-outline.png" alt="food"/>
        </q-item>
        <q-list-header>Menu</q-list-header>
        <q-item to="/home">
          <q-item-side icon="search" />
          <q-item-main label="Quero Pedir"
          sublabel="Busque por restaurantes e faça seu pedido" />
        </q-item>
        <q-item to="/restaurants">
          <q-item-side icon="fastfood" />
          <q-item-main label="Tenho um restaurante"
          sublabel="Cadastre seu restaurante e receba pedidos" />
        </q-item>
        <q-item to="/orders">
          <q-item-side icon="shopping_cart" />
          <q-item-main label="Meus pedidos"
          sublabel="Acompanhe seus últimos pedidos" />
        </q-item>
        <q-item to="/auth">
          <q-item-side icon="account_box" />
          <q-item-main label="Entrar"
          sublabel="Acesse sua conta" />
        </q-item>
      </q-list>
    </q-layout-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { openURL } from 'quasar';

export default {
  name: 'MyLayout',
  data() {
    return {
      leftDrawerOpen: this.$q.platform.is.desktop,
    };
  },
  computed: {
    cart_count() {
      return this.$store.getters['cart/count'];
    },
  },
  methods: {
    openURL,
  },
  watch: {
    cart_count(newValue, oldValue) {
      if (newValue > oldValue) {
        // console.log(newValue, oldValue);
        this.$q.notify({
          message: 'Pedido atualizado!',
          detail: 'Um novo item foi adicionado ao seu pedido, quer ir para o carrinho de compras?',
          type: 'positive',
          actions: [
            {
              label: 'Ver pedido',
              handler: () => {
                this.$router.push('/cart');
              },
            },
          ],
        });
      }
    },
  },
  mounted() {
    // setTimeout(() => {
    //   this.cart_count += 1;
    // }, 1000);
    // setTimeout(() => {
    //   this.cart_count += 1;
    // }, 5000);
    this.$store.dispatch('cart/openDB');
    this.$store.dispatch('cart/list');
  },
};
</script>

<style>
#sidebar .q-item.router-link-active {
  background: rgba(0, 0, 0, 0.1);
}
#sidebar .q-item.q-link:hover {
  background: rgba(0, 0, 0, 0.1);
}
#sidebar .q-item img {
  width: 80%;
  height: auto;
}
.logo {
  width:70%;
  margin:auto;
}
</style>
