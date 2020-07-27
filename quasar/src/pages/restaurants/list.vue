<template>
  <q-page padding>
    <h1 class="q-display-2">
      Seus Restaurantes
    </h1>

    <q-table
      title="Restaurantes"
      :data="tableData"
      :columns="columns">
      <q-tr slot="body" slot-scope="props">
        <q-td key="id" class="text-right">
          {{ props.row.id }}
        </q-td>
        <q-td key="title" class="text-left">
          {{ props.row.title }}
        </q-td>
        <q-td key="actions" class="text-right">
          <q-btn color="secondary" class="q-mr-sm" size="sm"
          :to="'/restaurant/' + props.row.id + '/detail'">+ Detalhes</q-btn>
          <q-btn color="primary" class="q-mr-sm" size="sm"
          :to="'/restaurant/' + props.row.id + '/edit'">Editar</q-btn>
        </q-td>
      </q-tr>
    </q-table>

    <q-btn color="primary" to="/new-restaurant" class="q-my-md">Novo restaurante</q-btn>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      /* tableData: [
        {
          id: 1,
          title: 'Nome do restaurante',
        },
        {
          id: 2,
          title: 'Nome do restaurante',
        },
      ], */
      columns: [
        {
          field: 'id',
          label: '',
        },
        {
          field: 'title',
          label: 'Título',
        },
      ],
    };
  },
  // computed pode receber os dados do vuex
  computed: {
    tableData() {
      return this.$store.state.restaurants.list;
    },
  },
  mounted() {
    this.$store.dispatch('restaurants/all', this)
      .then(() => {
        if (this.tableData.length === 0) {
          this.$router.push('/new-restaurant');
        }
      });
  },
};
</script>

<style>
</style>
