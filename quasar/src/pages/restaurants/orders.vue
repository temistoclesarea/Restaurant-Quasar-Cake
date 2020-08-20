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
        class="cursor-pointer">
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
          <q-select
            v-model="status"
            float-label="Status"
            radios
            :options="selectOptions"
            @input="update(props.row.id)"/>
        </q-td>
      </q-tr>
      </q-table>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      status: null,
      selectOptions: [
        {
          label: 'Confirmar pedido',
          value: 'confirmed',
        },
        {
          label: 'Saiu para entrega',
          value: 'in_delivery',
        },
        {
          label: 'Entrega realizada',
          value: 'done',
        },
      ],
      columns: [
        {
          field: 'id',
          label: '',
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
    update(id) {
      const data = {
        status: this.status,
      };
      this.$store.dispatch('orders/edit', { vue: this, id, data });
    },
  },
  mounted() {
    this.$store.dispatch('orders/all', { vue: this, id: this.$route.params.id });
  },
};
</script>

<style>
#orders-table td {
  padding: 22px 8px;
}
</style>
