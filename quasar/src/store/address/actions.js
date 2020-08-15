import qs from 'qs';

export function all(context, vue) {
  return vue.$axios.get('/addresses.json')
    .then((res) => {
      context.commit('setList', res.data.addresses);
    });
}

export function create(context, config) {
  const { vue } = config;
  const { data } = config;

  return vue.$axios.post('/addresses/add.json', qs.stringify(data));
}
