<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">Detalhes do Pedido</h2>
    <div v-if="pedido">
      <p><strong>Nome:</strong> {{ pedido.nome }}</p>
      <p><strong>Status:</strong> {{ pedido.status }}</p>
    </div>
    <router-link to="/pedidos" class="text-facebook hover:underline">Voltar para a Lista de Pedidos</router-link>
  </div>
</template>

<script>
import { getPedido } from '../api';

export default {
  data() {
    return {
      pedido: null,
    };
  },
  async created() {
    const { id } = this.$route.params;
    this.pedido = await getPedido(id);
  },
};
</script>

<style scoped>
p {
  margin-bottom: 1rem;
}

@media (max-width: 768px) {
  .text-2xl {
    font-size: 1.5rem;
  }
  p {
    margin-bottom: 0.5rem;
  }
}
</style>
