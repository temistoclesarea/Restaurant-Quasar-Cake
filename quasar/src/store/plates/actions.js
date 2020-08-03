export function all(context, options) {
  const { vue } = options;
  const { id } = options;

  return vue.$axios.get(`/plates/index/${id}.json`)
    .then((res) => {
      context.commit('setList', res.data.plates);
    });
}

export function create(context, options) {
  const { vue } = options;
  const { data } = options;
  return vue.$axios.post('/plates/add.json', data);
}

export function current(context, options) {
  const { vue } = options;
  const { id } = options;
  return vue.$axios.get(`plates/view/${id}.json`)
    .then((res) => {
      context.commit('setCurrent', res.data.plate);
    });
}

export function update(context, options) {
  const { vue } = options;
  const { data } = options;
  const { id } = options;
  return vue.$axios.post(`plates/edit/${id}.json`, data)
    .then((res) => {
      context.commit('setCurrent', res.data.plate);
    });
}
