<template>
  <q-page padding>
    <h1 class="q-display-2">
      Meus pedidos
    </h1>

    <q-table
      id="orders-table"
      title="Últimos pedidos"
      :data="tableData"
      :columns="columns"
      row-key="id">
      <q-tr
        slot="body"
        slot-scope="props"
        class="cursor-pointer"
        @click.native="gotToOrder(props.row.id)">
        <q-td key="id" class="text-right">
          {{ props.row.id }}
        </q-td>
        <q-td key="restaurant" class="text-right">
          {{ props.row.restaurant }}
        </q-td>
        <q-td key="created" class="text-right">
          {{ props.row.created }}
        </q-td>
        <q-td key="price" class="text-right">
          {{ props.row.price }}
        </q-td>
        <q-td key="status" class="text-right">
          {{ props.row.status }}
        </q-td>
        <q-td key="actions" class="text-right">
          <q-btn color="primary" size="sm">+ detalhes</q-btn>
        </q-td>
      </q-tr>
      </q-table>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      tableData: [
        {
          id: 2,
          restaurant: 'nome do restaurante',
          created: '01/06/2020',
          price: 'R$ 30,00',
          status: 'Entregue',
        },
        {
          id: 1,
          restaurant: 'nome do restaurante',
          created: '01/06/2020',
          price: 'R$ 40,00',
          status: 'Entregue',
        },
      ],
      columns: [
        {
          field: 'id',
          label: ' ',
        },
        {
          field: 'restaurant',
          label: 'Restaurante',
        },
        {
          field: 'created',
          label: 'Data do pedido',
        },
        {
          field: 'price',
          label: 'Preço',
        },
        {
          field: 'status',
          label: 'Status do pedido',
        },
      ],
    };
  },
  methods: {
    gotToOrder(id) {
      this.$router.push(`/order/${id}/details`);
    },
  },
};
</script>

<style>
#orders-table td {
  padding: 22px 8px;
}
</style>
