// import qs from 'qs'; // para serializar a informação para o formato correto

export function all(context, vue) {
  return vue.$axios.get('/restaurants.json')
    .then((res) => { // atualiza a resposta do servidor dentro do mutations
      context.commit('setList', res.data.restaurants);
    });
}

export function current(context, config) {
  const { vue } = config; // mesma coisa de config.vue
  const { id } = config; // mesma coisa de config.id

  return vue.$axios.get(`/restaurants/${id}.json`)
    .then((res) => {
      context.commit('setCurrent', res.data.restaurant);
    });
}

export function create(context, config) {
  const { vue } = config; // mesma coisa de config.vue
  const { data } = config; // mesma coisa de config.data

  // não foi utilizado por o formData já faz o trabalho de serializar
  // let { data } = config; // mesma coisa de config.data
  // key=valor&key2=valor2...
  // data = qs.stringify(data); // pega cada item de data e transforma em valor serializado para php

  return vue.$axios.post('/restaurants/add.json', data);
}
