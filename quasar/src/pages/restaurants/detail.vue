<template>
  <q-page padding>
    <h1 class="q-display-2">
      Detalhes do restaurante
    </h1>

    <q-card class="q-mb-md">
      <q-card-main>
        <p>Título: Meu restaurante</p>
        <p>Tempo de entrega: 50 minutos</p>
        <p>Valor de entrega: R$ 10,00</p>
        <hr>
        <p>
          Rua. Fulano, 212 - Centro<br>
          Teresina - PI - Cep: 64.000-000
        </p>
      </q-card-main>
    </q-card>

    <q-table
      title="Pratos"
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
          <q-btn color="primary" class="q-mr-sm" size="sm"
          :to="'/restaurant/plate/' + props.row.id + '/edit'">Editar</q-btn>
        </q-td>
      </q-tr>
    </q-table>

    <q-btn color="primary" to="/restaurant/plate/create" class="q-my-md">Novo prato</q-btn>
  </q-page>
</template>

<script>
export default {
  data() {
    return {
      tableData: [
        {
          id: 1,
          title: 'Nome do prato',
        },
        {
          id: 2,
          title: 'Nome do prato',
        },
      ],
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
  mounted() {
    if (this.tableData.length === 0) {
      this.$router.push('/new-restaurant');
    }
  },
};
</script>

<style>
</style>
