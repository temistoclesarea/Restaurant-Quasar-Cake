<template>
  <q-page padding>
    <h1 class="q-display-2">
      Detalhes do restaurante
    </h1>

    <q-card class="q-mb-md">
      <q-card-main>
        <p>Título: Meu {{ restaurant.title }}</p>
        <p>Tempo de entrega: {{ restaurant.delivery_time }}</p>
        <p>Valor de entrega: {{ restaurant.delivery_price }}</p>
        <hr>
        <p v-if="restaurant.address">
          {{ restaurant.address.address }},
          {{ restaurant.address.number }} - {{ restaurant.address.neighborhood }}<br>
          {{ restaurant.address.city }} - {{ restaurant.address.state }} -
          CEP: {{ restaurant.address.cep }}
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
  computed: {
    restaurant() {
      return this.$store.state.restaurants.current;
    },
  },
  mounted() {
    this.$store.dispatch('restaurants/current', { vue: this, id: this.$route.params.id });
  },
};
</script>

<style>
</style>
