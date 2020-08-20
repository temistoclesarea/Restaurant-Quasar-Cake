<template>
  <q-page padding>
    <h1 class="q-display-2">
      Carrinho de compras
    </h1>
    <q-card class="q-mb-sm" v-for="(product, i) in products" :key="i">
      <q-card-main class="row">
        <div class="col-md-1 col-xs-2">
          <img :src="'http://localhost:8765/uploader/plates/' + product.photo" alt="avatar"
          style="width:50px;" class="round-borders"/>
        </div>
        <div class="col flex items-center">
          {{ product.title }}
        </div>
        <div class="col-md-4 flex items-center justify-end">
          {{ product.qtd }} <q-btn color="green" class="q-mx-md" @click="add(product)">+</q-btn>
          <q-btn color="red" class="q-mr-md" @click="remove(product)">-</q-btn>
        </div>
        <div class="col-2 flex items-center justify-end">
          R$ {{ product.price * product.qtd | price }}
        </div>
      </q-card-main>
    </q-card>

    <div class="row">
      <q-card class="col-xs-12 col-md-6 offset-md-6 text-black text-right" color="grey-3">
        <q-card-main>
          Entrega: {{ parseInt(delivery) | price }}
        </q-card-main>
        <q-card-main>
          Pedido: {{ totalProducts | price }}
        </q-card-main>
        <q-card-main>
          Entrega: {{ total | price }}
        </q-card-main>
        <q-card-actions class="flex justify-end">
          <q-btn color="green" label="Fechar pedido" @click="buy()"/>
        </q-card-actions>
      </q-card>
    </div>
  </q-page>
</template>

<script>
export default {
  computed: {
    products() {
      return this.$store.state.cart.list;
    },
    delivery() {
      return this.restaurant.delivery_price || '0';
    },
    totalProducts() {
      let total = 0;
      this.products.forEach((value) => {
        total += value.qtd * value.price;
      });
      return total;
    },
    total() {
      const delivery = parseInt(this.delivery, 0);
      return this.totalProducts + delivery;
    },
    current() {
      return this.$store.state.cart.currentId;
      // return 1;
    },
    restaurant() {
      return this.$store.state.restaurants.current;
    },
    address() {
      return this.$store.state.address.list;
    },
  },
  filters: {
    price(value) {
      const formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2,
      });

      return formatter.format(value);
    },
  },
  methods: {
    add(data) {
      this.$store.dispatch('cart/add', data);
    },
    remove(data) {
      this.$store.dispatch('cart/remove', data);
    },
    buy() {
      // console.log('buy');
      this.$store.dispatch('address/all', this)
        .then(() => {
          const actions = [];

          this.address.forEach((a) => {
            actions.push({
              label: `${a.address}, ${a.number}, - ${a.neighborhood} - ${a.city} - Cep ${a.cep}`,
              icon: 'add_location',
              color: 'green',
              handler: () => {
                // this.$router.push(`/order/${a.id}`);
                const data = {
                  plates_orders: this.products,
                  total: this.total,
                  address_id: a.id,
                  restaurant_id: this.restaurant.id,
                };

                this.$store.dispatch('orders/create', { vue: this, data })
                  .then((res) => {
                    this.$store.dispatch('cart/clear');
                    this.$router.push(`/order/${res.data.order.id}`);
                  });
              },
            });
          });

          actions.push({});

          actions.push({
            label: 'Adicionar novo endereço',
            icon: 'add_circle',
            handler: () => {
              this.$router.push('/address/create');
            },
          });

          this.$q.actionSheet({
            title: 'Escolha o endereço',
            actions,
          });
        });
    },
  },
  mounted() {
    if (window.stores) {
      this.$store.dispatch('cart/list');
    }

    if (!this.$route.params.id && this.current) {
      this.$router.push(`/cart/${this.current}`);
    }
    if (this.$route.params.id && !this.current) {
      this.$store.dispatch('cart/current', this.$route.params.id);
    }
    this.$store.dispatch('restaurants/current', { vue: this, id: this.current });
  },
};
</script>

<style>
</style>
