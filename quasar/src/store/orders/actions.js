export function all(context, config) {
  const { vue } = config; // mesma coisa de config.vue
  const { id } = config; // mesma coisa de config.id

  return vue.$axios.get(`/orders.json/restaurant=${id}`)
    .then((res) => { // atualiza a resposta do servidor dentro do mutations
      context.commit('setList', res.data.orders);
    });
}

export function current(context, config) {
  const { vue } = config; // mesma coisa de config.vue
  const { id } = config; // mesma coisa de config.id

  return vue.$axios.get(`/orders/view/${id}.json`)
    .then((res) => {
      context.commit('setCurrent', res.data.order);
    });
}

export function create(context, config) {
  const { vue } = config; // mesma coisa de config.vue
  const { data } = config; // mesma coisa de config.data

  return vue.$axios.post('/orders/add.json', data);
}

export function edit(context, config) {
  const { vue } = config;
  const { data } = config;
  const { id } = config;

  return vue.$axios.post(`/orders/edit/${id}.json`, data);
}

export function search(context, options) {
  const { vue } = options;
  const { term } = options;

  return vue.$axios.get(`/orders/search.json?term=${term}`)
    .then((res) => { // atualiza a resposta do servidor dentro do mutations
      context.commit('setList', res.data.orders);
    });
}
