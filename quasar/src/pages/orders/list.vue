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
          {{ props.row.restaurant.title }}
        </q-td>
        <q-td key="created" class="text-right">
          {{ props.row.created  }} <!-- XXX: criar o campo created e modified no migrate -->
        </q-td>
        <q-td key="price" class="text-right">
          {{ props.row.total }}
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
  computed: {
    tableData() {
      return this.$store.state.orders.list;
    },
  },
  methods: {
    gotToOrder(id) {
      this.$router.push(`/order/${id}/details`);
    },
  },
  mounted() {
    this.$store.dispatch('orders/all', { vue: this });
  },
};
</script>

<style>
#orders-table td {
  padding: 22px 8px;
}
</style>
