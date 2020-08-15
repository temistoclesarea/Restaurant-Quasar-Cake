import Vue from 'vue';
import Vuex from 'vuex';

import restaurants from './restaurants';
import plates from './plates';
import cart from './cart';
import address from './address';

Vue.use(Vuex);

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      restaurants,
      plates,
      cart,
      address,
    },
  });

  return Store;
}
