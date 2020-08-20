<template>
  <q-page padding>
    <h1 class="q-display-2">
      Pedido
    </h1>

    <q-stepper ref="stepper" color="green" :no-header-navigation="true">
      <q-step name="payment"
        title="Forma de pagamento"
        active-icon="access_time"
      >
        <h5 class="text-center">Qual a forma de pagamento?</h5>
        <p class="text-center">
          <q-btn label="Escolher" color="primary" @click="payment_form=true"/>
        </p>
      </q-step>
      <q-step name="in_confirmation"
        title="Pedido recebido"
        active-icon="access_time"
      >
        <h5 class="text-center">Aguarde a confirmação do restaurante?</h5>
      </q-step>
      <q-step name="confirmed"
        title="Confirmação do restaurante"
        active-icon="access_time"
      >
        <h5 class="text-center">Pedido confirmado</h5>
        <p class="text-center">
          Estamos preparando o seu pedido, ele deve ser entregue a partir de 40 minutos.
        </p>
      </q-step>
      <q-step name="in_delivery"
        title="Saiu para Entrega"
        active-icon="access_time"
      >
        <h5 class="text-center">O entregador está a caminho</h5>
        <p class="text-center">
          Fique de olho no seu celular, o entregador pode precisar de informações.
        </p>
      </q-step>
      <q-step name="done"
        title="Entregue"
        active-icon="access_time"
      >
        <h5 class="text-center">Bom apetite!</h5>
      </q-step>
      <!-- <q-stepper-navigation>
        <q-btn flat @click="$refs.stepper.previous()" label="Voltar"/>
        <q-btn flat @click="$refs.stepper.next()" label="Avançar"/>
      </q-stepper-navigation> -->
    </q-stepper>

    <q-modal v-model="payment_form" content-classes="q-pa-md" :no-backdrop-dismiss="true">
      <h4>Forma de pagamento</h4>
      <q-field>
        <q-radio v-model="payment" val="1" label="Dinheiro"/>
      </q-field>

      <q-field>
        <q-radio v-model="payment" val="2" label="Cartão de Crédito"/>
      </q-field>

      <q-field>
        <q-radio v-model="payment" val="3" label="Cartão de Débito"/>
      </q-field>

      <div v-if="payment === '1'">
        <q-field>
          <q-input
            type="text"
            v-model="change"
            float-label="Troco para?"
          />
        </q-field>
      </div>
      <!-- <q-btn
        label="Confirmar pedido?"
        color="primary"
        class="q-mt-sm"
        @click="payment_form = false"
      /> -->

      <q-btn
        label="Confirmar pedido?"
        color="primary"
        class="q-mt-sm"
        @click="pay()"
      />
    </q-modal>


  </q-page>
</template>

<script>
export default {
  data() {
    return {
      payment_form: false,
      payment: '1',
      change: 0.00,
    };
  },
  computed: {
    order() {
      return this.$store.state.orders.current;
    },
  },
  methods: {
    pay() {
      if (this.payment === '1' && this.change < this.order.total) {
        this.$q.notify({
          message: 'O valor deve ser maior que o total da compra.',
        });
        return;
      }
      this.payment_form = false;
      const data = {
        payment_method: this.payment,
        payment_price: this.change,
        status: 'in_confirmation',
      };

      this.$store.dispatch('orders/edit', { vue: this, id: this.order.id, data })
        .then(() => {
          this.$refs.stepper.next();
        });
    },
    getServerData() {
      this.$store.dispatch('orders/current', { vue: this, id: this.$route.params.id })
        .then(() => {
          this.$refs.stepper.goToStep(this.order.status);
          const setedTime = 5 * 1000;
          setTimeout(this.getServerData, setedTime);
        });
    },
  },
  mounted() {
    this.getServerData();
  },
};
</script>

<style>
</style>
