<template>
  <q-page padding>
    <h1 class="q-display-2">
      Pedido
    </h1>

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

        <q-btn
          label="Confirmar pedido?"
          color="primary"
          class="q-mt-sm"
          @click="payment_form = false"
        />
      </div>
    </q-modal>


  </q-page>
</template>

<script>
export default {
  data() {
    return {
      payment_form: true,
      payment: '1',
      change: 0.00,
    };
  },
};
</script>

<style>
</style>
