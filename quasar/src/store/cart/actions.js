import * as localForage from 'localforage';

export function openDB() {
  const cart = localForage.createInstance({
    name: 'cart',
    storeName: 'products',
  });

  window.stores = {
    cart,
  };
}

export function add(context, data) {
  return new Promise((resolve) => {
    window.stores.cart.getItem(data.id, (err, value) => {
      if (value === null) {
        data.qtd = 1;
      } else {
        data.qtd = value.qtd + 1;
      }
    });
    // id unico e data é todos os data como objeto
    window.stores.cart.setItem(data.id, data)
      .then(() => resolve);
  });
}

export function remove(context, data) {
  window.stores.cart.getItem(data.id, (err, value) => {
    if (value === null) {
      return;
    }
    data.qtd = value.qtd - 1;
    if (data.qtd <= 0) {
      window.stores.cart.removeItem(data.id);
    } else {
      window.stores.cart.setItem(data.id, data);
    }
  });
}

export function list(context) {
  const products = [];
  window.stores.cart.iterate((value) => {
    let restaurantId = context.state.currentId;
    // as vezes o restaurantId vem como string e precisa converter
    if (typeof restaurantId === 'string') {
      restaurantId = parseInt(restaurantId, 0);
    }

    if (restaurantId === value.restaurant_id) {
      products.push(value);
    }

    context.commit('addToList', products);
  });
}

export function current(context, id) {
  context.commit('setCurrent', id);
}

export function clear(context) {
  context.commit('addToList', []);
  window.stores.cart.clear();
}
