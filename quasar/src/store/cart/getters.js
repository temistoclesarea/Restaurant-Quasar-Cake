// eslint-disable-next-line import/prefer-default-export
export function count(state) {
  let total = 0;
  state.list.forEach((p) => {
    total += p.qtd;
  });
  return total;
}
