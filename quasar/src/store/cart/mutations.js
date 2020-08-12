export function addToList(state, products) {
  state.list = products;
}

export function setCurrent(state, id) {
  state.currentId = id;
}
