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
        <q-item to="/">
          <q-item-side icon="search" />
          <q-item-main label="Quero Pedir"
          sublabel="Busque por restaurantes e faça seu pedido" />
        </q-item>
        <q-item to="">
          <q-item-side icon="fastfood" />
          <q-item-main label="Tenho um restaurante"
          sublabel="Cadastre seu restaurante e receba pedidos" />
        </q-item>
        <q-item to="">
          <q-item-side icon="shopping_cart" />
          <q-item-main label="Meus pedidos"
          sublabel="Acompanhe seus últimos pedidos" />
        </q-item>
        <q-item to="">
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
  methods: {
    openURL,
  },
};
</script>

<style>
  .logo {
    width:200px;
    margin:auto;
  }
</style>
