<template>
  <div>
    <h1>Detalhe do Pedido</h1>
    <div v-if="pedido">
      <p>ID: {{ pedido.id }}</p>
      <p>Usuário ID: {{ pedido.usuario_id }}</p>
      <p>Produto ID: {{ pedido.produto_id }}</p>
      <p>Quantidade: {{ pedido.quantidade }}</p>
      <p>Status: {{ pedido.status }}</p>
      <router-link to="/pedidos">Voltar para a lista de pedidos</router-link>
    </div>
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
    const id = this.$route.params.id;
    this.pedido = await getPedido(id);
  },
};
</script>
